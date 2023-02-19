<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CoreComponentRepository;
use App\Models\Category;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use App\Models\Product;
use App\Services\WholesaleService;
use App\Models\AttributeValue;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Combinations;



class WholesaleProductController extends Controller
{
    public function __construct()
    {
        // Staff Permission Check
        $this->middleware(['permission:view_all_wholesale_products'])->only('all_wholesale_products');
        $this->middleware(['permission:view_inhouse_wholesale_products'])->only('in_house_wholesale_products');
        $this->middleware(['permission:view_sellers_wholesale_products'])->only('seller_wholesale_products');
        $this->middleware(['permission:add_wholesale_product'])->only('product_create_admin');
        $this->middleware(['permission:edit_wholesale_product'])->only('product_edit_admin');
        $this->middleware(['permission:delete_wholesale_product'])->only('product_destroy_admin');
    }

    public function all_wholesale_products(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $type = 'All';
        $col_name = null;
        $query = null;
        $sort_search = null;
        $seller_id  = null;

        $products = Product::where('wholesale_product', 1)->orderBy('created_at', 'desc');

        if ($request->has('user_id') && $request->user_id != null) {
            $products = $products->where('user_id', $request->user_id);
            $seller_id = $request->user_id;
        }

        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }
        if ($request->search != null) {
            $products = $products
                ->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }

        $products = $products->paginate(15);

        return view('wholesale.products.index', compact('products', 'type', 'col_name', 'query', 'sort_search', 'seller_id'));
    }





    public function in_house_wholesale_products(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $type = 'In House';
        $col_name = null;
        $query = null;
        $sort_search = null;

        $products = Product::where('wholesale_product', 1)->where('added_by', 'admin')->orderBy('created_at', 'desc');

        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }
        if ($request->search != null) {
            $products = $products
                ->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }

        $products = $products->paginate(15);

        return view('wholesale.products.index', compact('products', 'type', 'col_name', 'query', 'sort_search'));
    }





    public function seller_wholesale_products(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $type = 'Seller';
        $col_name = null;
        $query = null;
        $sort_search = null;
        $seller_id  = null;

        $products = Product::where('wholesale_product', 1)->where('added_by', 'seller')->orderBy('created_at', 'desc');

        if ($request->has('user_id') && $request->user_id != null) {
            $products = $products->where('user_id', $request->user_id);
            $seller_id = $request->user_id;
        }

        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }
        if ($request->search != null) {
            $products = $products
                ->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }

        $products = $products->paginate(15);

        return view('wholesale.products.index', compact('products', 'type', 'col_name', 'query', 'sort_search', 'seller_id'));
    }

    // Wholesale Products list in Seller panel
    public function wholesale_products_list_seller(Request $request)
    {
        $sort_search = null;
        $col_name = null;
        $query = null;
        $products = Product::where('wholesale_product', 1)->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc');
        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }
        if ($request->search != null) {
            $products = $products
                ->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }

        $products = $products->paginate(15);

        return view('wholesale.frontend.seller_products.index', compact('products', 'sort_search', 'col_name'));
    }




    public function product_create_admin()
    {
        CoreComponentRepository::initializeCache();
        $countries = Country::where('status', 1)->get();
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('wholesale.products.create', compact('categories', 'countries'));
    }



    public function product_create_seller()
    {
        $countries = Country::where('status', 1)->get();
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();

        //  if (get_setting('seller_wholesale_product') == 1) {
        // if (addon_is_activated('seller_subscription')) {
        //     if (Auth::user()->shop->seller_package != null && Auth::user()->shop->seller_package->product_upload_limit > Auth::user()->products()->count()) {
        //         return view('wholesale.frontend.seller_products.create', compact('categories', 'countries'));
        //     } else {
        //         flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
        //         return back();
        //     }
        // } else {
        // }
        // }
        return view('wholesale.frontend.seller_products.create', compact('categories','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function product_store_admin(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'category_ids' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'min_qty' => 'required|numeric',
            'tags' => 'required',
            'current_stock' => 'required',
            'unit_price'  => 'required',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id'  => 'required',
            'city_id'  =>  'required',
            'country_to_id' => 'required',
            'state_to_id'  => 'required',
            'city_to_id'  =>  'required',
        ]);


        (new WholesaleService)->store($request);
        // Multiple Category Insert

        return redirect()->route('wholesale_products.in_house');
    }

    public function product_store_seller(Request $request)
    {
            $request->validate([
            'name' => 'required|max:255|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'category_ids' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'min_qty' => 'required|numeric',
            'tags' => 'required',
            'current_stock' => 'required',
            'unit_price'  => 'required',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id'  => 'required',
            'city_id'  =>  'required',
            'country_to_id' => 'required',
            'state_to_id'  => 'required',
            'city_to_id'  =>  'required',
        ]);
        // if (addon_is_activated('seller_subscription')) {
        //     if (Auth::user()->shop->seller_package == null || Auth::user()->shop->seller_package->product_upload_limit <= Auth::user()->products()->count()) {
        //         flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
        //         return back();
        //     }
        // }

        (new WholesaleService)->store($request);
        return redirect()->route('seller.wholesale_products_list');
    }


    public function product_edit_admin(Request $request, $id)
    {
        CoreComponentRepository::initializeCache();
        $countries = Country::where('status', 1)->get();

        $product = Product::findOrFail($id);
        if ($product->digital == 1) {
            return redirect('digitalproducts/' . $id . '/edit');
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
            ->get();
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
        return view('wholesale.products.edit', compact('product', 'categories', 'tags', 'lang', 'productCategories', 'countries', 'productShippingfroms', 'productShippingtos', 'productAttributes', 'productChoices', 'attributeChoices',));
    }

    public function product_edit_seller(Request $request, $id)
    {
        $countries = Country::where('status', 1)->get();
        $product = Product::findOrFail($id);
        if ($product->digital == 1) {
            return redirect('digitalproducts/' . $id . '/edit');
        }

        $lang = $request->lang;
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        $productCategories = DB::table('category_product')
            ->leftjoin('categories', 'category_product.category_id', '=', 'categories.id')
            ->select('category_product.*', 'categories.name')
            ->where('category_product.product_id', '=', $id)
            ->get();
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

        return view('wholesale.frontend.seller_products.edit', compact('product', 'categories', 'tags', 'lang', 'productCategories','attributeChoices','productChoices', 'productAttributes','countries', 'productShippingfroms', 'productShippingtos'));
    }


    public function product_update_admin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'category_ids' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'min_qty' => 'required|numeric',
            'tags' => 'required',
            'current_stock' => 'required',
            'unit_price'  => 'required',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id'  => 'required',
            'city_id'  =>  'required',
            'country_to_id' => 'required',
            'state_to_id'  => 'required',
            'city_to_id'  =>  'required',
        ]);
        (new WholesaleService)->update($request, $id);
        return back();
    }

    public function product_update_seller(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'category_ids' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'min_qty' => 'required|numeric',
            'tags' => 'required',
            'current_stock' => 'required',
            'unit_price'  => 'required',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id'  => 'required',
            'city_id'  =>  'required',
            'country_to_id' => 'required',
            'state_to_id'  => 'required',
            'city_to_id'  =>  'required',
        ]);
        (new WholesaleService)->update($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_destroy_admin($id)
    {
        (new WholesaleService)->destroy($id);
        return back();
    }

    public function product_destroy_seller($id)
    {
        (new WholesaleService)->destroy($id);
        return back();
    }


    public function getDefaultAttributes(Request $request)
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


    public function add_more_choice_option(Request $request)
    {
        $all_attribute_values = AttributeValue::with('attribute')->where('is_price', '=', 'No')->where('attribute_id', $request->attribute_id)->get();

        $html = '';

        foreach ($all_attribute_values as $row) {
            $html .= '<option value="' . $row->value . '">' . $row->value . '</option>';
        }
        echo json_encode($html);
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
}
