<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\State;
use App\Models\ShippingCost;
use Illuminate\Support\Facades\DB;

class SellerCityController extends Controller
{
    public function __construct()
    {
        // Staff Permission Check
        //        $this->middleware(['permission:manage_shipping_cities'])->only('index','create','destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sellerstates = ShippingCost::where('seller_id', '=', auth()->user()->id)->paginate(10);
        $sort_city = $request->sort_city;
        $sort_state = $request->sort_state;
        $cities_queries = City::query();
        if ($request->sort_city) {
            $cities_queries->where('name', 'like', "%$sort_city%");
        }
        if ($request->sort_state) {
            $cities_queries->where('state_id', $request->sort_state);
        }
        $cities = $cities_queries->orderBy('status', 'desc')->paginate(10);
        $states = State::where('status', 1)->get();
        return view('seller.shipping.cities.index', compact('cities', 'states', 'sellerstates', 'sort_city', 'sort_state'));
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
        $city = new City;

        $city->name = $request->name;
        $city->cost = $request->cost;
        $city->state_id = $request->state_id;
        $city->save();

        DB::table('shipping_costs')->insert([
            'seller_id' =>  auth()->user()->id,
            'city_id'  =>  $city->id,
            'city_name'  =>   $city->name,
            'cost'     =>  $request->cost,
            'state_id'  =>  $city->state_id,
            'status'     =>  1,
        ]);


        flash(translate('City has been inserted successfully'))->success();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang  = $request->lang;
        $city  = City::findOrFail($id);
        $states = State::where('status', 1)->get();
        return view('seller.shipping.cities.edit', compact('city', 'lang', 'states'));
    }

    public function eaditcost(Request $request, $id)
    {

        $lang  = $request->lang;
        $city  = ShippingCost::findOrFail($id);
        $states = State::where('status', 1)->get();
        return view('seller.shipping.cities.createCost', compact('city', 'lang', 'states'));
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
        $city = City::findOrFail($id);

        DB::table('shipping_costs')->insert([
            'seller_id' =>  auth()->user()->id,
            'city_id'  =>  $city->id,
            'city_name'  =>  $city->name,
            'cost'     =>  $request->cost,
            'state_id'  =>  $city->state_id,
            'status'     =>  1,
        ]);

        flash(translate('City has been updated successfully'))->success();
        return redirect()->route('seller.cities.index');
    }

    public function updateSellerCost(Request $request, $id)
    {
        DB::table('shipping_costs')->where('id', '=', $id)->update([
            'city_name' => $request->city_name,
            'cost' => $request->cost,
            'state_id' => $request->state_id,
            'status' => 1,
        ]);

        flash(translate('City has been updated successfully'))->success();
        return redirect()->route('seller.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        ShippingCost::destroy($id);

        flash(translate('City has been deleted successfully'))->success();
        return redirect()->route('seller.cities.index');
    }

    public function updateStatus(Request $request)
    {

        $city = ShippingCost::findOrFail($request->id);
        $city->status = $request->status;
        $city->save();

        return 1;
    }
}
