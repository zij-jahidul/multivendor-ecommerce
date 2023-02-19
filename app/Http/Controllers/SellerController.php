<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EmailVerificationNotification;
use Cache;
use Str;

class SellerController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:view_all_seller'])->only('index');
        $this->middleware(['permission:view_seller_profile'])->only('profile_modal');
        $this->middleware(['permission:login_as_seller'])->only('login');
        $this->middleware(['permission:pay_to_seller'])->only('payment_modal');
        $this->middleware(['permission:edit_seller'])->only('edit');
        $this->middleware(['permission:delete_seller'])->only('destroy');
        $this->middleware(['permission:ban_seller'])->only('ban');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $approved = null;
        $shops = Shop::whereIn('user_id', function ($query) {
                       $query->select('id')
                       ->from(with(new User)->getTable());
                    })->latest();

        if ($request->has('search')) {
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'seller')->where(function ($user) use ($sort_search) {
                $user->where('name', 'like', '%' . $sort_search . '%')->orWhere('email', 'like', '%' . $sort_search . '%');
            })->pluck('id')->toArray();
            $shops = $shops->where(function ($shops) use ($user_ids) {
                $shops->whereIn('user_id', $user_ids);
            });
        }
        if ($request->approved_status != null) {
            $approved = $request->approved_status;
            $shops = $shops->where('verification_status', $approved);
        }
        $shops = $shops->paginate(15);
        return view('backend.sellers.index', compact('shops', 'sort_search', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('email', $request->email)->first() != null) {
            flash(translate('Email already exists!'))->error();
            return back();
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = "seller";
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            if (get_setting('email_verification') != 1) {
                $user->email_verified_at = date('Y-m-d H:m:s');
            } else {
                $user->notify(new EmailVerificationNotification());
            }
            $user->save();

            $seller = new Seller;
            $seller->user_id = $user->id;

            if ($seller->save()) {
                $shop = new Shop;
                $shop->user_id = $user->id;
                $shop->slug = 'demo-shop-' . $user->id;
                $shop->save();

                flash(translate('Seller has been inserted successfully'))->success();
                return redirect()->route('sellers.index');
            }
        }
        flash(translate('Something went wrong'))->error();
        return back();
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
    public function edit($id)
    {
        $shop = Shop::findOrFail(decrypt($id));
        return view('backend.sellers.edit', compact('shop'));
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
        $shop = Shop::findOrFail($id);
        $user = $shop->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if (strlen($request->password) > 0) {
            $user->password = Hash::make($request->password);
        }
        if ($user->save()) {
            if ($shop->save()) {
                flash(translate('Seller has been updated successfully'))->success();
                return redirect()->route('sellers.index');
            }
        }

        flash(translate('Something went wrong'))->error();
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
        $shop = Shop::findOrFail($id);
        Product::where('user_id', $shop->user_id)->delete();
        $orders = Order::where('user_id', $shop->user_id)->get();

        foreach ($orders as $key => $order) {
            OrderDetail::where('order_id', $order->id)->delete();
        }
        Order::where('user_id', $shop->user_id)->delete();

        User::destroy($shop->user->id);

        if (Shop::destroy($id)) {
            flash(translate('Seller has been deleted successfully'))->success();
            return redirect()->route('sellers.index');
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function bulk_seller_delete(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $shop_id) {
                $this->destroy($shop_id);
            }
        }

        return 1;
    }

    public function show_verification_request($id)
    {
        $shop = Shop::findOrFail($id);
        return view('backend.sellers.verification', compact('shop'));
    }

    public function approve_seller($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->verification_status = 1;
        if ($shop->save()) {
            Cache::forget('verified_sellers_id');
            flash(translate('Seller has been approved successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function reject_seller($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->verification_status = 0;
        $shop->verification_info = null;
        if ($shop->save()) {
            Cache::forget('verified_sellers_id');
            flash(translate('Seller verification request has been rejected successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }


    public function payment_modal(Request $request)
    {
        $shop = shop::findOrFail($request->id);
        return view('backend.sellers.payment_modal', compact('shop'));
    }

    public function profile_modal(Request $request)
    {
        $shop = Shop::findOrFail($request->id);
        return view('backend.sellers.profile_modal', compact('shop'));
    }

    public function updateApproved(Request $request)
    {
        $shop = Shop::findOrFail($request->id);
        $shop->verification_status = $request->status;
        if ($shop->save()) {
            Cache::forget('verified_sellers_id');
            return 1;
        }
        return 0;
    }

    public function login($id)
    {
        $shop = Shop::findOrFail(decrypt($id));
        $user  = $shop->user;
        auth()->login($user, true);

        return redirect()->route('seller.dashboard');
    }

    public function ban($id)
    {
        $shop = Shop::findOrFail($id);

        if ($shop->user->banned == 1) {
            $shop->user->banned = 0;
            flash(translate('Seller has been unbanned successfully'))->success();
        } else {
            $shop->user->banned = 1;
            flash(translate('Seller has been banned successfully'))->success();
        }

        $shop->user->save();
        return back();
    }


    public function import()
    {
        //die("ttt");
        // $shop = Shop::findOrFail($request->id);
        return view('backend.sellers.import');
    }
    public function importpost(Request $request)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        //$path = Storage::disk('local')->put('app-csv-translations', $request->lang_file);
        $path = $request->bulk_file;
        $file = fopen($path, "r"); //open the file
        // $fileName = $_FILES["file"]["tmp_name"];
        $row = 0;
        while(($data = fgetcsv($file)) !== FALSE){
            if($row == 0){


                $row++;
                continue;
            }
            $companyname = trim($data[0]);
            if(trim($data[2]) == ''){
                $email = Str::slug($companyname).'@kemetro.com';
            }else{
                $email = trim($data[2]);
            }
            $companyname = trim($data[0]);
            $user = User::where('email', '=', $email)->first();

            if (!$user ) {

                if(trim($data[1]) != ''){
                    $password = substr(str_replace(" ","",trim($data[1])), -6);
                }else{
                    $password = '11321';
                }

                //echo $password;
                //die('eeee');

                $user = new User();
                $user->user_type = 'seller';
                $user->name = $companyname;
                $user->email = $email;
                $user->password = $password;

                $user = new User;
                $user->name = $companyname;
                $user->email = $email;
                $user->user_type = "seller";
                $user->phone = trim($data[1]);
                $user->address = trim($data[4]);
                $user->password = Hash::make($password);

                $user->save();

                $seller = new Seller();
                $seller->user_id = $user->id;
                $seller->verification_status =0;

                if ($seller->save()) {


                    $imgArr = array();
                    $image1 = trim($data[10]);
                    if($image1 != ''){
                        $imgArr[] = $image1;
                    }
                    $image2 = trim($data[11]);
                    if($image2 != ''){
                        $imgArr[] = $image2;
                    }
                    $image3 = trim($data[12]);
                    if($image3 != ''){
                        $imgArr[] = $image3;
                    }
                    $image4 = trim($data[13]);
                    if($image4 != ''){
                        $imgArr[] = $image4;
                    }

                    $image5 = trim($data[14]);
                    if($image5 != ''){
                        $imgArr[] = $image5;
                    }

                    $image6 = trim($data[15]);
                    if($image6 != ''){
                        $imgArr[] = $image6;
                    }
                    $image7 = trim($data[16]);
                    if($image7 != ''){
                        $imgArr[] = $image7;
                    }
                    $image8 = trim($data[17]);
                    if($image8 != ''){
                        $imgArr[] = $image8;
                    }
                    $image9 = trim($data[18]);
                    if($image9 != ''){
                        $imgArr[] = $image9;
                    }
                    $image10 = trim($data[19]);
                    if($image10 != ''){
                        $imgArr[] = $image10;
                    }

                    $gallery = array();
                    if(!empty($imgArr)){
                        foreach($imgArr as $img){
                            $arrContextOptions=array(
                                "ssl"=>array(
                                    "verify_peer"=>false,
                                    "verify_peer_name"=>false,
                                ),
                            );
                            //$newextend = explode("/", $img);
                            //$imagex = strtolower(end($newextend));
                            $imagex = rand(10000 , 1000000000000).".jpg";
                            $imageString = @file_get_contents($img,false, stream_context_create($arrContextOptions));
                            if($imageString){
                                if (!@file_exists(public_path(). '/uploads/all/' . $imagex, $imageString)) {
                                    file_put_contents(public_path(). '/uploads/all/' . $imagex, $imageString);

                                    $uploadimage = 'uploads/all/'.$imagex;
                                    $arr = explode('.', $imagex);
                                    $upload = new Upload();
                                    $upload->file_original_name = basename($imagex);
                                    $upload->file_name = $uploadimage;
                                    //$upload->user_id = User::where('user_type', 'admin')->first()->id;
                                    $upload->user_id = $user->id;
                                    $upload->extension = $arr[1];
                                    $upload->type = isset($type[$arr[1]]) ?  $type[$arr[1]] : "image";
                                    $upload->file_size = 0;

                                    $upload->save();
                                    $gallery[] = $upload->id;
                                }
                            }
                        }

                    }//end if gallery


                    $shop = new Shop();
                    $shop->user_id = $user->id;
                    $shop->name = trim($companyname);
                    $shop->gallery = json_encode($gallery);

                    $shop->slug = Str::slug($companyname) .'-'. $user->id;
                    $shop->phone = trim($data[1]);
                    $shop->address = trim($data[4]);
                    $shop->latitude = trim($data[5]);
                    $shop->longitude = trim($data[6]);
                    $shop->rating = str_replace(" " , "." , trim($data[7]));
                    $shop->reviews = trim($data[8]);
                    $shop->category = trim($data[9]);
                    $shop->website = trim($data[3]);
                    $shop->workinghour = trim($data[20]);
                    $shop->facebook = trim($data[21]);
                    $shop->instagram = trim($data[22]);
                    $shop->twitter = trim($data[24]);
                    $shop->linkedin = trim($data[23]);

                    $shop->save();

                }//end if seller

            }//end user
            else{
                Shop::where('user_id', $user->id)
                    ->update(
                        [
                            'latitude'=>trim($data[5]),
                            'longitude' => trim($data[6]),
                            'rating' => str_replace(" " , "." , trim($data[7])),
                            'reviews' => trim($data[8]),
                            'category' => trim($data[9]),
                            'website' => trim($data[3]),
                            'workinghour' => trim($data[20]),
                            'linkedin' => trim($data[23])
                        ]
                    );
            }

            //die('end one');


        }//end while

        fclose($file);


        flash(translate('CSV file has been imported successfully.'))->success();
        return back();
    }

}
