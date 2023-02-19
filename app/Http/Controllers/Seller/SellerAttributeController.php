<?php

namespace App\Http\Controllers\Seller;

use Str;
use App\Models\Color;
use App\Models\Attribute;
use CoreComponentRepository;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\AttributeTranslation;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        CoreComponentRepository::instantiateShopRepository();
        CoreComponentRepository::initializeCache();
        $attributes = Attribute::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $categories = Category::where('parent_id', 0)
                        ->with('childrenCategories')
                        ->get();
        return view('seller.product.attribute.index', compact('attributes','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $attribute = new Attribute;
        $attribute->name = $request->name;
        $attribute->user_id = Auth::id();
        $attribute->save();
        
         // Multiple Category Insert
         foreach($request->category_ids as $category_id) {
            DB::table('attribute_category')->insert([
                'category_id'   =>    $category_id,
                'attribute_id'   =>    $attribute->id
            ]);
        }
        $attribute_translation = AttributeTranslation::firstOrNew(['lang' => 'en', 'attribute_id' => $attribute->id]);
        $attribute_translation->name = $request->name;
        $attribute_translation->save();

        flash(translate('Seller Attribute has been inserted successfully'))->success();
        return redirect()->route('seller.sellerattributes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['attribute'] = Attribute::findOrFail($id);
        $data['all_attribute_values'] = AttributeValue::with('attribute')->where('attribute_id', $id)->get();

        // echo '<pre>';print_r($data['all_attribute_values']);die;

        return view("seller.product.attribute.attribute_value.index", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang      = 'en';
        $attribute = Attribute::findOrFail($id);
        return view('seller.product.attribute.edit', compact('attribute', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $attribute = Attribute::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $attribute->name = $request->name;
            $attribute->user_id = Auth::id();
        }
        $attribute->save();

        $attribute_translation = AttributeTranslation::firstOrNew(['lang' => $request->lang, 'attribute_id' => $attribute->id]);
        $attribute_translation->name = $request->name;
        $attribute_translation->save();

        flash(translate('Attribute has been updated successfully'))->success();
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
        $attribute = Attribute::findOrFail($id);

        foreach ($attribute->attribute_translations as $key => $attribute_translation) {
            $attribute_translation->delete();
        }

        Attribute::destroy($id);
        flash(translate('Attribute has been deleted successfully'))->success();
        return redirect()->route('seller.sellerattributes.index');
    }


    public function langedit(Request $request, $id)
    {
        $lang      = $request->lang;
        $attribute = Attribute::findOrFail($id);
        return view('seller.product.attribute.langedit', compact('attribute', 'lang'));
    }

    public function store_attribute_value(Request $request)
    {
        $attribute_value = new AttributeValue;
        $attribute_value->attribute_id = $request->attribute_id;
        $attribute_value->value = ucfirst($request->value);
        $attribute_value->is_price = $request->isprice;
        $attribute_value->slug = str_replace(' ','-', $request->value);
        $attribute_value->save();

        flash(translate('Attribute value has been inserted successfully'))->success();
        return redirect()->route('seller.sellerattributes.show', $request->attribute_id);
    }

    public function edit_attribute_value(Request $request, $id)
    {
        $attribute_value = AttributeValue::findOrFail($id);
        return view("seller.product.attribute.attribute_value.edit", compact('attribute_value'));
    }

    public function update_attribute_value(Request $request, $id)
    {
        $attribute_value = AttributeValue::findOrFail($id);
        $attribute_value->is_price = $request->isprice;
        $attribute_value->slug = str_replace(' ','-', $request->value);
        $attribute_value->attribute_id = $request->attribute_id;
        $attribute_value->value = ucfirst($request->value);

        $attribute_value->save();

        flash(translate('Attribute value has been updated successfully'))->success();
        return back();
    }

    public function destroy_attribute_value($id)
    {
        $attribute_values = AttributeValue::findOrFail($id);
        AttributeValue::destroy($id);

        flash(translate('Attribute value has been deleted successfully'))->success();
        return redirect()->route('seller.sellerattributes.show', $attribute_values->attribute_id);
    }

    public function colors(Request $request)
    {
        $sort_search = null;
        $colors = Color::where('user_id', Auth::id())->orderBy('created_at', 'desc');

        if ($request->search != null) {
            $colors = $colors->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }
        $colors = $colors->paginate(10);

        return view('seller.product.color.index', compact('colors', 'sort_search'));
    }

    public function store_color(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:colors|max:255',
        ]);
        $color = new Color;
        $color->name = Str::replace(' ', '', $request->name);
        $color->code = $request->code;
        $color->user_id = Auth::id();
        $color->save();

        flash(translate('Color has been inserted successfully'))->success();
        return redirect()->route('seller.colors');
    }

    public function edit_color(Request $request, $id)
    {
        $color = Color::findOrFail($id);
        return view('seller.product.color.edit', compact('color'));
    }

    /**
     * Update the color.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_color(Request $request, $id)
    {
        $color = Color::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:colors,code,' . $color->id,
        ]);

        $color->name = Str::replace(' ', '', $request->name);
        $color->code = $request->code;
        $color->user_id = Auth::id();
        $color->save();

        flash(translate('Color has been updated successfully'))->success();
        return back();
    }

    public function destroy_color($id)
    {
        Color::destroy($id);

        flash(translate('Color has been deleted successfully'))->success();
        return redirect()->route('seller.colors');
    }
}
