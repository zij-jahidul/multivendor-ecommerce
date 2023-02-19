<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ShippingCost;
use App\Models\Product;
use App\Models\ProductTax;
use App\Models\ProductTranslation;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use Carbon\Carbon;
use Combinations;
use Artisan;
use Auth;
use Str;


use App\Services\ProductService;
use App\Services\ProductTaxService;
use App\Services\ProductFlashDealService;
use App\Services\ProductStockService;

class ProductController extends Controller
{
    protected $productService;
    protected $productTaxService;
    protected $productFlashDealService;
    protected $productStockService;

    public function __construct(
        ProductService $productService,
        ProductTaxService $productTaxService,
        ProductFlashDealService $productFlashDealService,
        ProductStockService $productStockService
    ) {
        $this->productService = $productService;
        $this->productTaxService = $productTaxService;
        $this->productFlashDealService = $productFlashDealService;
        $this->productStockService = $productStockService;
    }

    public function index(Request $request)
    {
        $search = null;
        $products = Product::where('user_id', Auth::user()->id)->where('digital', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $search = $request->search;
            $products = $products->where('name', 'like', '%' . $search . '%');
        }

        $products = $products->paginate(10);
        return view('seller.product.products.index', compact('products', 'search'));
    }

    public function create(Request $request)
    {
        // if (addon_is_activated('seller_subscription')) {
        //     if (seller_package_validity_check()) {
        //         $countries = Country::where('status', 1)->get();

        //         $categories = Category::where('parent_id', 0)
        //             ->where('digital', 0)
        //             ->with('childrenCategories')
        //             ->get();
        //         return view('seller.product.products.create', compact('categories', 'countries'));
        //     } else {
        //         flash(translate('Please upgrade your package.'))->warning();
        //         return back();
        //     }
        // }
        $countries = Country::where('status', 1)->get();
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('seller.product.products.create', compact('categories', 'countries'));
    }

    public function store(ProductRequest $request)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'category_ids' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'weight' => 'required',
            'min_qty' => 'required|numeric',
            'tags' => 'required',
            'current_stock' => 'required',
            'unit_price'  => 'required',
            'discount'  => 'nullable',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id'  => 'required',
            'city_id'  =>  'required',
            'country_to_id' => 'required',
            'state_to_id'  => 'required',
            'city_to_id'  =>  'required',
        ]);

        // if (addon_is_activated('seller_subscription')) {
        //     if (!seller_package_validity_check()) {
        //         flash(translate('Please upgrade your package.'))->warning();
        //         return redirect()->route('seller.products');
        //     }
        // }

        $product = $this->productService->store($request->except([
            '_token', 'sku', 'choice', 'tax_id', 'tax', 'tax_type', 'flash_deal_id', 'flash_discount', 'flash_discount_type'
        ]));

        $request->merge(['product_id' => $product->id]);

        // Barcode or Qr Code Generator
        $barcode_generate = Str::slug($request->name . '-' . rand(999999, 999999999));
        $product->barcode = $barcode_generate;
        $product->dimension_hwl = $request->dimension_hwl;
        $product->save();


        // Shipping From & Shipping To  Start
        $from_country = Country::where('id', $request->country_id)->first();
        $from_city = State::where('id', $request->state_id)->first();
        $from_district = City::where('id', $request->city_id)->first();
        $to_country = Country::where('id', $request->country_to_id)->first();
        $to_city = State::where('id', $request->state_to_id)->first();
        $multi_district = [];
        $multi_cost = [];
        foreach ($request->city_to_id as $to_single_district) {
            $to_district_name = City::where('id', $to_single_district)->first();
            $multi_district[] = $to_district_name->name;
            $multi_cost[] = $to_district_name->cost;
        }

        DB::table('product_shipping_from')->insert([
            'product_id' =>  $product->id,
            'from_country' => $from_country->name,
            'from_city' => $from_city->name,
            'from_district' => $from_district->name,
        ]);

        DB::table('product_shipping_to')->insert([
            'product_id' =>  $product->id,
            'to_country' => $to_country->name,
            'to_city' => $to_city->name,
            'to_district' => json_encode($multi_district),
            'shipping_to_cost' => json_encode($multi_cost),
        ]);
        // Shipping From & Shipping To End

        // Multiple Category Insert
        foreach ($request->category_ids as $category_id) {
            DB::table('category_product')->insert([
                'product_id'    =>     $product->id,
                'category_id'   =>    $category_id,
                'status'   =>    'Yes',
            ]);
        }

        foreach ($request->choice_attributes as $choice_attribute) {
            DB::table('product_attributes')->insert([
                'product_id'    =>          $product->id,
                'attribute_id'   =>         $choice_attribute
            ]);
        }

        foreach ($request->choice_options as $choice_option) {
            DB::table('product_choices')->insert([
                'product_id'    =>          $product->id,
                'value'   =>         $choice_option
            ]);
        }
        // Customer More Choice Option for product Start
        $array_product_title = $request->product_title;
        $array_type_value = $request->type_value;
        $array_product_name = $request->product_name;
        $array_product_quantity = $request->product_quantity;
        $array_product_price = $request->product_price;
        $array_product_stock = $request->product_stock;

        if ($array_product_title != null) {
            for ($i = 0; $i < count($array_product_title); $i++) {
                $datasave = [
                    'product_id' => $product->id,
                    'product_title' => $array_product_title[$i],
                    'type_value' => $array_type_value[$i],
                    'product_name' => $array_product_name[$i],
                    'product_quantity' => $array_product_quantity[$i],
                    'product_price' => $array_product_price[$i],
                    'product_stock' => $array_product_stock[$i],
                ];
                DB::table('customer_more_choice')->insert($datasave);
            }
            // Customer More Choice Option for product End
        }

        //VAT & Tax
        if ($request->tax_id) {
            $this->productTaxService->store($request->only([
                'tax_id', 'tax', 'tax_type', 'product_id'
            ]));
        }

        //Product Stock
        $this->productStockService->store($request->only([
            'colors_active', 'colors', 'choice_no', 'unit_price', 'sku', 'current_stock', 'product_id'
        ]), $product);

        // Product Translations
        $request->merge(['lang' => 'en']);
        ProductTranslation::create($request->only([
            'lang', 'name', 'unit', 'description', 'product_id'
        ]));

        flash(translate('Product has been inserted successfully'))->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return redirect()->route('seller.products');
    }





    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (Auth::user()->id != $product->user_id) {
            flash(translate('This product is not yours.'))->warning();
            return back();
        }

        $lang = 'en';
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        $productCategories = DB::table('category_product')
            ->leftjoin('categories', 'category_product.category_id', '=', 'categories.id')
            ->select('category_product.*', 'categories.name')
            ->where('category_product.product_id', '=', $id)
            ->where('category_product.status', '=', 'Yes')
            ->get();
        $productAttributes = DB::table('product_attributes')
            ->leftjoin('attributes', 'product_attributes.attribute_id', '=', 'attributes.id')
            ->select('product_attributes.*', 'attributes.name')
            ->where('product_attributes.product_id', '=', $id)
            ->get();

        $productChoices = DB::table('product_choices')
            ->leftjoin('attribute_values', 'product_choices.value', '=', 'attribute_values.slug')
            ->select('product_choices.*', 'attribute_values.value as valueName')
            ->where('product_choices.product_id', '=', $id)->get();
        $attributeChoices = DB::table('attribute_values')->get();


        //     shipping from and to
        $countries = Country::where('status', 1)->get();
        $productShippingfroms = DB::table('product_shipping_from')
            ->leftjoin('countries', 'product_shipping_from.from_country', '=', 'countries.name')
            ->select('product_shipping_from.*', 'countries.name')
            ->where('product_shipping_from.product_id', '=', $id)
            ->get();
        $productShippingtos = DB::table('product_shipping_to')
            ->leftjoin('countries', 'product_shipping_to.to_country', '=', 'countries.name')
            ->select('product_shipping_to.*', 'countries.name')
            ->where('product_shipping_to.product_id', '=', $id)
            ->get();


        return view('seller.product.products.edit', compact('product', 'categories', 'tags', 'lang', 'productCategories', 'productAttributes', 'productChoices', 'attributeChoices','countries','productShippingfroms' ,'productShippingtos'));
    }

    public function update(ProductRequest $request, Product $product)
    {


        $request->validate([
            'name' => 'required|max:255|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'category_ids' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'weight' => 'required',
            'min_qty' => 'required|numeric',
            'tags' => 'required',
            'current_stock' => 'required',
            'unit_price'  => 'required',
            'discount'  => 'nullable',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id'  => 'required',
            'city_id'  =>  'required',
            'country_to_id' => 'required',
            'state_to_id'  => 'required',
            'city_to_id'  =>  'required',
        ]);


        //Product
        $product = $this->productService->update($request->except([
            '_token', 'sku', 'choice', 'tax_id', 'tax', 'tax_type', 'flash_deal_id', 'flash_discount', 'flash_discount_type'
        ]), $product);

        //Product Stock
        foreach ($product->stocks as $key => $stock) {
            $stock->delete();
        }
        $request->merge(['product_id' => $product->id]);
        $this->productStockService->store($request->only([
            'colors_active', 'colors', 'choice_no', 'unit_price', 'sku', 'current_stock', 'product_id'
        ]), $product);

        //VAT & Tax
        if ($request->tax_id) {
            ProductTax::where('product_id', $product->id)->delete();
            $request->merge(['product_id' => $product->id]);
            $this->productTaxService->store($request->only([
                'tax_id', 'tax', 'tax_type', 'product_id'
            ]));
        }

        // Multiple Category Insert
        foreach ($request->category_ids as $category_id) {
            $productCategoryCheck = DB::table('category_product')->where('product_id', '=', $product->id)->first();
            if (!empty($productCategoryCheck)) {
                DB::table('category_product')->where('product_id', '=', $product->id)->delete();
                /* DB::table('category_product')->where('product_id','=',null)->where('category_id','=',null)->delete(); */
            }
        }
        foreach ($request->category_ids as $category_id) {

            DB::table('category_product')->insert([
                'product_id'    =>     $product->id,
                'category_id'   =>      $category_id,
                'status'        =>      'Yes',
            ]);
        }


        //multiple attributes
        foreach ($request->choice_attributes as $choice_attribute) {
            $productCategoryCheck = DB::table('product_attributes')->where('product_id', '=', $product->id)->first();
            if (!empty($productCategoryCheck)) {
                DB::table('product_attributes')->where('product_id', '=', $product->id)->delete();
            }
        }

        foreach ($request->choice_attributes as $choice_attribute) {
            DB::table('product_attributes')->insert([
                'product_id'    =>          $product->id,
                'attribute_id'   =>         $choice_attribute
            ]);
        }


        // Multiple Choice Insert
        foreach ($request->choice_options as $value) {
            $productChoiceCheck = DB::table('product_choices')->where('product_id', '=', $product->id)->first();
            if (!empty($productChoiceCheck)) {
                DB::table('product_choices')->where('product_id', '=', $product->id)->delete();
            }
        }
        foreach ($request->choice_options as $value) {

            DB::table('product_choices')->insert([
                'product_id'    =>     $product->id,
                'value'   =>      $value
            ]);
        }



        // Shipping From & Shipping To  Start
        $from_country = Country::where('id', $request->country_id)->first();
        $from_city = State::where('id', $request->state_id)->first();
        $from_district = City::where('id', $request->city_id)->first();
        $to_country = Country::where('id', $request->country_to_id)->first();
        $to_city = State::where('id', $request->state_to_id)->first();
        $multi_district = [];
        $multi_cost = [];

        foreach ($request->city_to_id as $to_single_district) {
            $to_district = City::where('id', $to_single_district)->first();
            $to_seller_district = ShippingCost::where('city_id', $to_single_district)->first();

            $multi_district[] = $to_district->name;

            if (isset($to_seller_district)){
                $multi_cost[] = $to_seller_district->cost;
            }else{
                $multi_cost[] = $to_district->cost;
            }
        }


        DB::table('product_shipping_from')->where('product_id', '=',  $product->id)->update([
            'from_country' => $from_country->name,
            'from_city' => $from_city->name,
            'from_district' => $from_district->name,
        ]);

        DB::table('product_shipping_to')->where('product_id', '=',  $product->id)->update([
            'to_country' => $to_country->name,
            'to_city' => $to_city->name,
            'to_district' => json_encode($multi_district),
            'shipping_to_cost' => json_encode($multi_cost)
        ]);


        // Product Translations
        ProductTranslation::where('lang', $request->lang)
            ->where('product_id', $request->product_id)
            ->update($request->only([
                'lang', 'name', 'unit', 'description', 'product_id'
            ]));

        flash(translate('Product has been updated successfully'))->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return back();
    }

    public function sku_combination(Request $request)
    {
        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name;
        $combinations = Combinations::makeCombinations($options);
        return view('seller.product.products.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }




    public function sku_combination2(Request $request)
    {

        $options = array();
        $unit_price = $request->unit_price;
        $product_name = $request->name;
        array_push($options, $request->choice_options);
        $values = $request->choice_options;
        $combinations = Combinations::makeCombinations($options);
        return view('seller.product.products.sku_choice_combinations', compact('combinations', 'values', 'options', 'unit_price', 'product_name'));
    }



    public function sku_combination_edit(Request $request)
    {

        $product = Product::findOrFail($request->id);
        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                foreach ($request[$name] as $key => $item) {
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        return view('seller.product.products.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }



    public function sku_combination_edit2(Request $request)
    {

        $product = Product::findOrFail($request->id);
        $options = array();
        $product_name = $request->name;
        $unit_price = $request->unit_price;
        array_push($options, $request->choice_options);

        $combinations = Combinations::makeCombinations($options);
        return view('backend.product.products.sku_combinations_edit', compact('combinations', 'unit_price', 'product_name', 'product'));
    }



    public function add_more_choice_option(Request $request)
    {
        $all_attribute_values = AttributeValue::with('attribute')->where('attribute_id', $request->attribute_id)->get();

        $html = '';

        foreach ($all_attribute_values as $row) {
            $html .= '<option value="' . $row->value . '">' . $row->value . '</option>';
        }

        echo json_encode($html);
    }

    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;
        if (addon_is_activated('seller_subscription') && $request->status == 1) {
            $shop = $product->user->shop;
            if (
                $shop->package_invalid_at == null
                || Carbon::now()->diffInDays(Carbon::parse($shop->package_invalid_at), false) < 0
                || $shop->product_upload_limit <= $shop->user->products()->where('published', 1)->count()
            ) {
                return 2;
            }
        }
        $product->save();
        return 1;
    }

    public function updateFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->seller_featured = $request->status;
        if ($product->save()) {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            return 1;
        }
        return 0;
    }

    public function duplicate($id)
    {
        $product = Product::find($id);
        if (Auth::user()->id != $product->user_id) {
            flash(translate('This product is not yours.'))->warning();
            return back();
        }
        if (addon_is_activated('seller_subscription')) {
            if (!seller_package_validity_check()) {
                flash(translate('Please upgrade your package.'))->warning();
                return back();
            }
        }

        if (Auth::user()->id == $product->user_id) {
            $product_new = $product->replicate();
            $product_new->slug = $product_new->slug . '-' . Str::random(5);
            $product_new->save();

            //Product Stock
            $this->productStockService->product_duplicate_store($product->stocks, $product_new);

            //VAT & Tax
            $this->productTaxService->product_duplicate_store($product->taxes, $product_new);

            flash(translate('Product has been duplicated successfully'))->success();
            return redirect()->route('seller.products');
        } else {
            flash(translate('This product is not yours.'))->warning();
            return back();
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (Auth::user()->id != $product->user_id) {
            flash(translate('This product is not yours.'))->warning();
            return back();
        }

        $product->product_translations()->delete();
        $product->stocks()->delete();
        $product->taxes()->delete();


        if (Product::destroy($id)) {
            Cart::where('product_id', $id)->delete();

            flash(translate('Product has been deleted successfully'))->success();

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            return back();
        } else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }


    public function getChoiceOption(Request $request)
    {
        for ($i = 0; count($request->attribute_id); $i++) {
            $attributes = DB::table('attribute_values')->whereIn('attribute_id', $request->attribute_id)->get();
            $html = '';
            $html .= '<option value="" disabled> Choose values</option>';
            foreach ($attributes as $attribute) {
                $html .= '<option value=' . $attribute->slug . '>' . $attribute->value . '</option>';
            }
            return $html;
        }
    }

    public function getSellerAttributes(Request $request)
    {
        for ($i = 0; count($request->category_id); $i++) {
            $attributes = DB::table('attribute_category')
                ->leftjoin('attributes', 'attribute_category.attribute_id', '=', 'attributes.id')
                ->select('attribute_category.attribute_id', 'attributes.name')
                ->whereIn('attribute_category.category_id', $request->category_id)
                ->distinct()
                ->get();

            $html = '';
            foreach ($attributes as $attribute) {
                $html .= '<option value="' . $attribute->attribute_id . '">' . $attribute->name . '</option>';
            }
            return $html;
        }
    }
}
