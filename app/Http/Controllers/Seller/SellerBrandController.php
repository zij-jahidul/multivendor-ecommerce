<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\BrandTranslation;
use App\Models\Product;
use Auth;
use DB;
use Illuminate\Support\Str;

class SellerBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $brands = Brand::where('user_id', Auth::id())->orderBy('name', 'asc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $brands = $brands->where('name', 'like', '%' . $sort_search . '%');
        }
        $brands = $brands->paginate(15);
        // return view('backend.product.brands.index', compact('brands', 'sort_search'));
        return view('seller.product.brands.index', compact('brands', 'sort_search'));
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
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;

        if ($request->slug != null) {
            $brand->slug = str_replace(' ', '-', $request->slug);
        } else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);
        }

        $brand->logo = $request->logo;
        $brand->verify = 0;
        $brand->user_id = Auth::id();
        $brand->save();

        $brand_translation = BrandTranslation::firstOrNew(['lang' => 'en', 'brand_id' => $brand->id]);
        $brand_translation->name = $request->name;
        $brand_translation->meta_title = $request->meta_title;
        $brand_translation->meta_description = $request->meta_description;
        $brand_translation->save();

        flash(translate('Brand has been inserted successfully'))->success();
        return redirect()->route('seller.sellerbrands.index');
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
    public function edit(Request $request, $id)
    {
        $lang   = 'en';
        $brand  = Brand::findOrFail($id);
        return view('seller.product.brands.edit', compact('brand', 'lang'));
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
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);

        $brand = Brand::findOrFail($id);
        if ($request->lang == 'en') {
            $brand->name = $request->name;
            $brand->meta_title = $request->meta_title;
            $brand->meta_description = $request->meta_description;
        }

        if ($request->slug != null) {
            $brand->slug = strtolower($request->slug);
        } else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);
        }
        $brand->logo = $request->logo;
        $brand->save();

        $brand_translation = BrandTranslation::firstOrNew(['lang' => $request->lang, 'brand_id' => $brand->id]);
        $brand_translation->name = $request->name;
        $brand_translation->meta_title = $request->meta_title;
        $brand_translation->meta_description = $request->meta_description;
        $brand_translation->save();

        flash(translate('Brand has been updated successfully'))->success();
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
        $brand = Brand::findOrFail($id);
        Product::where('brand_id', $brand->id)->delete();
        foreach ($brand->brand_translations as $key => $brand_translation) {
            $brand_translation->delete();
        }
        Brand::destroy($id);

        flash(translate('Brand has been deleted successfully'))->success();
        return redirect()->route('seller.sellerbrands.index');
    }
    //
    //    public function langedit(Request $request, $id)
    //    {
    //        $lang   = $request->lang;
    //        $brand  = Brand::findOrFail($id);
    //        return view('seller.product.brands.langedit', compact('brand', 'lang'));
    //    }


}
