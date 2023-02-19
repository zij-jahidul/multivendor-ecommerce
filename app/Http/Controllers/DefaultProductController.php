<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Category;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use App\Models\ProductTax;
use App\Models\AttributeValue;
use App\Models\Cart;
use Carbon\Carbon;
use Combinations;
use CoreComponentRepository;
use Artisan;
use Cache;
use Str;
use App\Services\ProductService;
use App\Services\ProductTaxService;
use App\Services\ProductFlashDealService;
use App\Services\ProductStockService;
use Illuminate\Support\Facades\DB;

class DefaultProductController extends Controller
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

        // Staff Permission Check
        $this->middleware(['permission:add_new_product'])->only('create');
        $this->middleware(['permission:show_all_products'])->only('all_products');
        $this->middleware(['permission:show_in_house_products'])->only('admin_products');
        $this->middleware(['permission:show_seller_products'])->only('seller_products');
        $this->middleware(['permission:product_edit'])->only('admin_product_edit', 'seller_product_edit');
        $this->middleware(['permission:product_duplicate'])->only('duplicate');
        $this->middleware(['permission:product_delete'])->only('destroy');
    }

    public function admin_default_products(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $type = 'In House';
        $col_name = null;
        $query = null;
        $sort_search = null;

        $products = Product::where('added_by', 'admin')->where('default_product', 1)->where('auction_product', 0)->where('wholesale_product', 0);

        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }
        if ($request->search != null) {
            $sort_search = $request->search;
            $products = $products
                ->where('name', 'like', '%' . $sort_search . '%')
                ->orWhereHas('stocks', function ($q) use ($sort_search) {
                    $q->where('sku', 'like', '%' . $sort_search . '%');
                });
        }

        $products = $products->where('digital', 0)->orderBy('created_at', 'desc')->paginate(15);

        return view('backend.default_product.products.index', compact('products', 'type', 'col_name', 'query', 'sort_search'));
    }


    public function seller_products(Request $request)
    {
        $col_name = null;
        $query = null;
        $seller_id = null;
        $sort_search = null;
        $products = Product::where('added_by', 'seller')->where('auction_product', 0)->where('wholesale_product', 0);
        if ($request->has('user_id') && $request->user_id != null) {
            $products = $products->where('user_id', $request->user_id);
            $seller_id = $request->user_id;
        }
        if ($request->search != null) {
            $products = $products
                ->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }
        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }

        $products = $products->where('digital', 0)->orderBy('created_at', 'desc')->paginate(15);
        $type = 'Seller';

        return view('backend.default_product.products.index', compact('products', 'type', 'col_name', 'query', 'seller_id', 'sort_search'));
    }

    public function all_products(Request $request)
    {
        $col_name = null;
        $query = null;
        $seller_id = null;
        $sort_search = null;
        $products = Product::orderBy('created_at', 'desc')->where('auction_product', 0)->where('wholesale_product', 0);
        if ($request->has('user_id') && $request->user_id != null) {
            $products = $products->where('user_id', $request->user_id);
            $seller_id = $request->user_id;
        }
        if ($request->search != null) {
            $sort_search = $request->search;
            $products = $products
                ->where('name', 'like', '%' . $sort_search . '%')
                ->orWhereHas('stocks', function ($q) use ($sort_search) {
                    $q->where('sku', 'like', '%' . $sort_search . '%');
                });
        }
        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }

        $products = $products->paginate(15);
        $type = 'All';

        return view('backend.default_product.products.index', compact('products', 'type', 'col_name', 'query', 'seller_id', 'sort_search'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        CoreComponentRepository::initializeCache();
        $countries = Country::where('status', 1)->get();
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();

        return view('backend.default_product.products.create', compact('categories', 'countries'));
    }

    public function add_more_choice_option(Request $request)
    {

        $all_attribute_values = AttributeValue::with('attribute')->where('is_price', '=', 'No')->where('attribute_id', $request->attribute_id)->get();

        $html = '';

        foreach ($all_attribute_values as $row) {
            $html .= '<option value="' . $row->value . '">' . $row->value . '</option>';
        }
        echo json_encode($html);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'brand_id' => 'required',
            'unit' => 'required',
            'weight' => 'required',
            'min_qty' => 'required|numeric',
            'unit_price'  => 'required',
            'discount'  => 'nullable',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id'  => 'required',
            'city_id'  =>  'required',
            'country_to_id' => 'required',
            'state_to_id'  => 'required',
        ]);

        $product = $this->productService->store(
            $request->except(
                [
                    '_token', 'sku', 'choice', 'tax_id', 'tax', 'tax_type', 'flash_deal_id', 'flash_discount', 'flash_discount_type'
                ]
            )
        );

        $request->merge(['product_id' => $product->id]);

        // Barcode or Qr Code Generator
        $barcode_generate = Str::slug($request->name . '-' . rand(999999, 999999999));
        $product->barcode = $barcode_generate;
        $product->default_product = 1;
        $product->save();

        // Multiple Category Insert
        foreach ($request->category_ids as $category_id) {
            DB::table('category_product')->insert([
                'product_id'    =>     $product->id,
                'category_id'   =>    $category_id
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

        //VAT & Tax
        if ($request->tax_id) {
            $this->productTaxService->store($request->only([
                'tax_id', 'tax', 'tax_type', 'product_id'
            ]));
        }

        //Flash Deal
        $this->productFlashDealService->store($request->only([
            'flash_deal_id', 'flash_discount', 'flash_discount_type'
        ]), $product);

        //Product Stock
        $this->productStockService->store($request->only([
            'colors_active', 'colors', 'choice_no', 'unit_price', 'sku', 'current_stock', 'product_id'
        ]), $product);

        flash(translate(' Default product has been inserted successfully'))->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return redirect()->route('defaults_products.admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_product_edit(Request $request, $id)
    {
        CoreComponentRepository::initializeCache();

        $product = Product::findOrFail($id);
        if ($product->digital == 1) {
            return redirect('admin/digitalproducts/' . $id . '/edit');
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



        return view('backend.default_product.products.edit', compact('product', 'categories', 'tags', 'lang', 'productCategories', 'productAttributes', 'productChoices', 'attributeChoices', 'countries', 'productShippingfroms', 'productShippingtos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function seller_product_edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->digital == 1) {
            return redirect('digitalproducts/' . $id . '/edit');
        }
        $lang = $request->lang;
        $tags = json_decode($product->tags);
        // $categories = Category::all();
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();

        return view('backend.product.products.edit', compact('product', 'categories', 'tags', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Multiple Category Insert
        foreach ($request->category_ids as $category_id) {
            $productCategoryCheck = DB::table('category_product')->where('product_id', '=', $product->id)->first();
            if (!empty($productCategoryCheck)) {
                DB::table('category_product')->where('product_id', '=', $product->id)->delete();
            }
        }
        foreach ($request->category_ids as $category_id) {

            DB::table('category_product')->insert([
                'product_id'    =>     $product->id,
                'category_id'   =>      $category_id,
                'status'   =>      'Yes',
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
            $multi_district[] = $to_district->name;
            $multi_cost[] = $to_district->cost;
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




        //        foreach($request->choice_attributes as $choice_attribute){
        //            DB::table('product_attributes')->insert([
        //                'product_id'    =>          $product->id,
        //                'attribute_id'   =>         $choice_attribute
        //            ]);
        //        }


        //Flash Deal
        $this->productFlashDealService->store($request->only([
            'flash_deal_id', 'flash_discount', 'flash_discount_type'
        ]), $product);

        //VAT & Tax
        if ($request->tax_id) {
            ProductTax::where('product_id', $product->id)->delete();
            $this->productTaxService->store($request->only([
                'tax_id', 'tax', 'tax_type', 'product_id'
            ]));
        }

        // Product Translations
        ProductTranslation::updateOrCreate(
            $request->only([
                'lang', 'product_id'
            ]),
            $request->only([
                'name', 'unit', 'description'
            ])
        );

        flash(translate('Product has been updated successfully'))->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->product_translations()->delete();
        $product->stocks()->delete();
        $product->taxes()->delete();

        if (Product::destroy($id)) {
            Cart::where('product_id', $id)->delete();

            flash(translate('Product has been deleted successfully'))->success();

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            return back();
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function bulk_product_delete(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $product_id) {
                $this->destroy($product_id);
            }
        }

        return 1;
    }

    /**
     * Duplicates the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Request $request, $id)
    {
        $product = Product::find($id);

        $product_new = $product->replicate();
        $product_new->slug = $product_new->slug . '-' . Str::random(5);
        $product_new->save();

        //Product Stock
        $this->productStockService->product_duplicate_store($product->stocks, $product_new);

        //VAT & Tax
        $this->productTaxService->product_duplicate_store($product->taxes, $product_new);

        flash(translate('Product has been duplicated successfully'))->success();
        if ($request->type == 'In House')
            return redirect()->route('products.admin');
        elseif ($request->type == 'Seller')
            return redirect()->route('products.seller');
        elseif ($request->type == 'All')
            return redirect()->route('products.all');
    }

    public function get_products_by_brand(Request $request)
    {
        $products = Product::where('brand_id', $request->brand_id)->get();
        return view('partials.product_select', compact('products'));
    }

    public function updateTodaysDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->todays_deal = $request->status;
        $product->save();
        Cache::forget('todays_deal_products');
        return 1;
    }

    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;
        // && addon_is_activated('seller_subscription') && $request->status == 1
        // if ($product->added_by == 'seller') {
        //     $shop = $product->user->shop;
        //     if (
        //         $shop->package_invalid_at == null
        //         || Carbon::now()->diffInDays(Carbon::parse($shop->package_invalid_at), false) < 0
        //         || $shop->product_upload_limit <= $shop->user->products()->where('published', 1)->count()
        //     ) {
        //         return 0;
        //     }
        // }
        $product->save();
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return 1;
    }

    public function updateProductApproval(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->approved = $request->approved;
        // && addon_is_activated('seller_subscription')
        // if ($product->added_by == 'seller') {
        //     $shop = $product->user->shop;
        //     if (
        //         $shop->package_invalid_at == null
        //         || Carbon::now()->diffInDays(Carbon::parse($shop->package_invalid_at), false) < 0
        //         || $shop->product_upload_limit <= $shop->user->products()->where('published', 1)->count()
        //     ) {
        //         return 0;
        //     }
        // }
        $product->save();
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return 1;
    }

    public function updateFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->featured = $request->status;
        if ($product->save()) {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            return 1;
        }
        return 0;
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

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                foreach ($request[$name] as $key => $item) {
                    // array_push($data, $item->value);
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);

        return view('backend.product.products.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
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
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                foreach ($request[$name] as $key => $item) {
                    // array_push($data, $item->value);
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        return view('backend.product.products.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }

    public function getSku(Request $request)
    {
        $html = '';
        foreach ($request->choice_options as $choiceOption) {

            $html .= $choiceOption;
        }
        return $html;
    }

    public function getDefaultAttributes(Request $request)
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
