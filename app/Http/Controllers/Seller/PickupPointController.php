<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Models\PickupPoint;
use Auth;
use App\Models\PickupPointTranslation;

class PickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $pickup_points = PickupPoint::where('staff_id' , Auth::id())->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $pickup_points = $pickup_points->where('name', 'like', '%'.$sort_search.'%');
        }
        $pickup_points = $pickup_points->paginate(10);
        return view('seller.setup_configurations.pickup_point.index', compact('pickup_points','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.setup_configurations.pickup_point.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo 'hello';
        
        // $request->validate([
        //     'name' => 'required',
        //     'address' => 'required',
        //     'phone' => 'required',
        // ]);

        // $pickup_point = new PickupPoint;
        // $pickup_point->name = $request->name;
        // $pickup_point->address = $request->address;
        // $pickup_point->phone = $request->phone;
        // $pickup_point->pick_up_status = $request->pick_up_status;
        // $pickup_point->staff_id = Auth::id();
        // if ($pickup_point->save()) {

        //     $pickup_point_translation = PickupPointTranslation::firstOrNew(['lang' => 'en', 'pickup_point_id' => $pickup_point->id]);
        //     $pickup_point_translation->name = $request->name;
        //     $pickup_point_translation->address = $request->address;
        //     $pickup_point_translation->save();

        //     flash(translate('PicupPoint has been inserted successfully'))->success();
        //     return redirect()->route('seller.pick_up_points.index');

        // }
        // else{
        //     flash(translate('Something went wrong'))->error();
        //     return back();
        // }
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
        $lang           = 'en';
        $pickup_point   = PickupPoint::findOrFail($id);
        return view('seller.setup_configurations.pickup_point.edit', compact('pickup_point','lang'));
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
            'address' => 'required',
            'phone' => 'required',
        ]);
        
        $pickup_point = PickupPoint::findOrFail($id);
        if($request->lang == 'en'){
            $pickup_point->name = $request->name;
            $pickup_point->address = $request->address;
        }

        $pickup_point->phone = $request->phone;
        $pickup_point->pick_up_status = $request->pick_up_status;
        $pickup_point->staff_id =  Auth::id();
        if ($pickup_point->save()) {

            $pickup_point_translation = PickupPointTranslation::firstOrNew(['lang' => $request->lang,  'pickup_point_id' => $pickup_point->id]);
            $pickup_point_translation->name = $request->name;
            $pickup_point_translation->address = $request->address;
            $pickup_point_translation->save();

            flash(translate('PicupPoint has been updated successfully'))->success();
            return redirect()->route('seller.pick_up_points.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pickup_point = PickupPoint::findOrFail($id);
        $pickup_point->pickup_point_translations()->delete();

        if(PickupPoint::destroy($id)){
            flash(translate('PicupPoint has been deleted successfully'))->success();
            return redirect()->route('seller.pick_up_points.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
}
