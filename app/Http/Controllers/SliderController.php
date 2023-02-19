<?php

namespace App\Http\Controllers;

use App\Models\SliderTranslation;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Models\Slider;
use Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'hello';
        // return view('backend.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider;
        $slider->user_id = Auth::id();

//        $slider->heading = $request->heading;
        $key_head = $request->heading;
        $lang_key_heading = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key_head)));
        $slider->heading = $lang_key_heading;


//        $slider->title = $request->title;
        $key_head = $request->title;
        $lang_key_heading = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key_head)));
        $slider->title = $lang_key_heading;

        $slider->link = $request->link;
        $slider->photo = $request->photo;
        // select position
        $slider->position_top = $request->position_top;
        $slider->position_right = $request->position_right;
        $slider->position_left = $request->position_left;
        $slider->position_bottom = $request->position_bottom;
        $slider->position_color = $request->position_color;
        $slider->save();

        $key_head = $request->heading;
        $lang_key_heading = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key_head)));

        $key_title = $request->title;
        $lang_key_title = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key_title)));



        $slider_translation = SliderTranslation::firstOrNew(['lang' => 'en', 'slider_id' => $slider->id]);
        $slider_translation->lang_key_heading = $lang_key_heading;
        $slider_translation->lang_key_title = $lang_key_title;
        $slider_translation->save();


        flash(translate('Slider has been inserted successfully'))->success();
        return redirect()->route('sliders.index');
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
        $lang = 'en';
        $slider  = Slider::findOrFail($id);
        return view('backend.sliders.edit', compact('slider','lang'));
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
        $slider = Slider::find($id);
        $slider->user_id = Auth::id();

//        $slider->heading = $request->heading;
        $key_head = $request->heading;
        $lang_key_heading = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key_head)));
        $slider->heading = $lang_key_heading;


//        $slider->title = $request->title;
        $key_head = $request->title;
        $lang_key_heading = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key_head)));
        $slider->title = $lang_key_heading;


        $slider->link = $request->link;
        $slider->photo = $request->photo;
        // select position
        $slider->position_top = $request->position_top;
        $slider->position_right = $request->position_right;
        $slider->position_left = $request->position_left;
        $slider->position_bottom = $request->position_bottom;
        $slider->position_color = $request->position_color;
        $slider->save();

//        $key_head = $request->heading;
//        $lang_key_heading = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key_head)));
//
//        $key_title = $request->title;
//        $lang_key_title = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key_title)));
//
//        $slider_translation = SliderTranslation::firstOrNew(['lang' => $request->lang, 'slider_id' => $slider->id]);
//        $slider_translation->lang_key_heading = $lang_key_heading;
//        $slider_translation->lang_key_title = $lang_key_title;
//        $slider_translation->save();


        flash(translate('Slider has been Updated successfully'))->success();
        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if (Slider::destroy($id)) {
            //unlink($slider->photo);
            flash(translate('Slider has been deleted successfully'))->success();
        } else {
            flash(translate('Something went wrong'))->error();
        }
        return redirect()->route('sliders.index');
    }


    public function langedit(Request $request,$id)
    {
        $lang = $request->lang;
        $slider  = Slider::findOrFail($id);
        return view('backend.sliders.langedit', compact('slider','lang'));
    }

    public function langupdate(Request $request,$id)
    {
//        $lang = $request->lang;
        $slider = SliderTranslation::where('slider_id','=',$id)->first();
        if (isset($slider))
        {
            $translation = Translation::where('lang',$request->lang)->where('lang_key' , $request->heading)->first();
            if (!isset($translation))
            {
                $translation = Translation::firstOrNew(['lang' => $request->lang, 'lang_key' => $slider->lang_key_heading]);
                $translation->lang_value = $request->heading;
                $translation->save();
            }
            $translation = Translation::where('lang',$request->lang)->where( 'lang_key',$request->title )->first();
//            $translation = Translation::where([$request->lang,'=','lang'], [$request->title,'=', 'lang_key'])->get();
            if (!isset($translation))
            {
                $translation = Translation::firstOrNew(['lang' => $request->lang, 'lang_key' => $slider->lang_key_title]);
                $translation->lang_value = $request->title;
                $translation->save();
            }


            flash(translate('Slider language has updated successfully'))->success();

            return redirect()->back();

        }else{

            flash(translate('Slider has not been found'))->success();
            return redirect()->back();
        }

    }
}
