<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Category;
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

class SellerDefaultProductController extends Controller
{

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
        $products = Product::where('default_product', 1)->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $search = $request->search;
            $products = $products->where('name', 'like', '%' . $search . '%');
        }
        $products = $products->paginate(10);
        return view('seller.product.defaultproducts.index', compact('products', 'search'));
    }

    // create
    public function create(Request $request, $id)
    {
        $product = Product::where('default_product', 1)->where('id', $id)->first();
        $lang = 'en';
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        $productChoices = DB::table('product_choices')
            ->leftjoin('attribute_values', 'product_choices.value', '=', 'attribute_values.slug')
            ->select('product_choices.*', 'attribute_values.value as valueName')
            ->where('product_choices.product_id', '=', $id)->get();
        $attributeChoices = DB::table('attribute_values')->get();
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
        return view('seller.product.defaultproducts.edit', compact('product', 'categories', 'tags', 'lang', 'productChoices', 'attributeChoices', 'productCategories', 'productAttributes','countries','productShippingfroms' ,'productShippingtos'));
    }

    public function update(Request $request)
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

        $product = $this->productService->store($request->except([
            '_token', 'sku', 'choice', 'tax_id', 'tax', 'tax_type', 'flash_deal_id', 'flash_discount', 'flash_discount_type'
        ]));

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
            $this->productTaxService->store($request->only([
                'tax_id', 'tax', 'tax_type', 'product_id'
            ]));
        }

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

        // Product Translations
        $request->merge(['lang' => 'en']);
        ProductTranslation::create($request->only([
            'lang', 'name', 'unit', 'description', 'product_id'
        ]));

        flash(translate('Default Product has been inserted successfully'))->success();
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return redirect()->route('seller.products');
    }


    public function editAttributes(Request $request)
    {
        for ($i = 0; count($request->category_id); $i++) {
            $attributes = DB::table('attribute_category')
                ->leftjoin('attributes', 'attribute_category.attribute_id', '=', 'attributes.id')
                ->select('attribute_category.attribute_id', 'attributes.name')
                ->whereIn('attribute_category.category_id', $request->category_id)
                ->get();
            $html = '';
            foreach ($attributes as $attribute) {
                $html .= '<option value="' . $attribute->attribute_id . '">' . $attribute->name . '</option>';
            }
            return $html;
        }
    }



    // sku_default product

    public function seller_add_more_choice_option(Request $request)
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

    public function seller_sku_combination(Request $request)
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
        return view('seller.product.products.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }

    public function seller_sku_combination_edit(Request $request)
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

    public function seller_getSku(Request $request)
    {
        $html = '';
        foreach ($request->choice_options as $choiceOption) {

            $html .= $choiceOption;
        }
        return $html;
    }
}
