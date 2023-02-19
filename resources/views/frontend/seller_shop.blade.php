@extends('frontend.layouts.app')

@section('meta_title'){{ $shop->meta_title }}@stop

@section('meta_description'){{ $shop->meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $shop->meta_title }}">
    <meta itemprop="description" content="{{ $shop->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($shop->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="website">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $shop->meta_title }}">
    <meta name="twitter:description" content="{{ $shop->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($shop->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $shop->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('shop.visit', $shop->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($shop->logo) }}" />
    <meta property="og:description" content="{{ $shop->meta_description }}" />
    <meta property="og:site_name" content="{{ $shop->name }}" />
@endsection


@section('content')
    <section class="pt-5 mb-4 bg-white">
        <div class="container">

            <div class="row">
                <div class="col-md-12 ">
                    <section class="" style="margin-bottom: 46px;">
                        <div class="container w-100">
                            <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true">
                                @if ($shop->sliders != null)
                                    @foreach (explode(',',$shop->sliders) as $key => $slide)
                                        <div class="carousel-box">
                                            <img class="d-block w-100 lazyload rounded h-200px h-lg-380px img-fit" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($slide) }}" alt="{{ $key }} offer">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>


            <!-- Demo Design -->
            <div class="row px-3">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="text-white p-3" style="background-color: #303352; ">
                        <div class="row">
                            <div class="col-lg-4" style="position:relative;">
                                <img
                                    class="lazyload"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="@if ($shop->logo !== null) {{ uploaded_asset($shop->logo) }} @else {{ static_asset('assets/img/placeholder.jpg') }} @endif"
                                    alt="{{ translate($shop->name)  }}"
                                    style="width: 120px; height: 120px; border-radius:50%;"
                                >
                                <h6 style="position:absolute; bottom: -10px; left: 22%; background-color: red; padding: 5px 10px; border-radius: 5px; font-weight: 700;">Preferred</h6>
                            </div>
                            <div class="col-lg-8">
                                <h4 class="m-0 p-0 pt-4" style="font-weight: 600p; font-size: 18px;">{{ translate($shop->name) }}</h4>
                                <p class="m-0 p-0" style="color: #6A8FA5;">Active 32mins ago</h4>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <a class="border py-2 px-6 text-white d-flex" href="#"> <i class="la la-plus mr-1" style="font-size: 18px;" aria-hidden="true"></i>{{ translate('Follow') }}</a>
                            </div>
                            <div class="col-lg-6">
                                <a class="border py-2 px-6 text-white d-flex" href="#"> <i class="la la-whatsapp mr-1" style="font-size: 18px;"></i>{{ translate('Chat') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                   <div>
                      <ul class="" style="list-style:none; font-size: 18px; font-weight: 500; padding: 10px 0; margin-top: 20px;">
                        <li><i class="la la-home mr-1" style="font-size: 18px;"></i>  {{ translate('Address') }} : <span class="text-danger" style="font-size: 14px;"> {{ translate($shop->address) }}</span> </li>
                        <li><i class="la la-mobile mr-1" style="font-size: 18px;"></i>  {{ translate('Phone') }} : <span class="text-danger" style="font-size: 14px;">{{ translate($shop->phone) }}</span> </li>
                          <li><i class="la la-legal mr-1" style="font-size: 18px;"></i>  {{ translate('Working Hour')  }} : <span class="text-danger" style="font-size: 14px;"> {{ translate($shop->workinghour) }}</span>  </li>

                      </ul>
                   </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div>
                        <ul class="" style="list-style:none; font-size: 18px; font-weight: 500; padding: 10px 0; margin-top: 20px;">
                            <li><i class="la la-gg-circle mr-1" style="font-size: 18px;"></i>  {{ translate('Review') }} : <span class="text-danger" style="font-size: 14px;">{{ translate($shop->reviews) }}</span> </li>

                            <div class="rating rating-sm mb-1">
                                <li><i class="la la-gratipay mr-1" style="font-size: 18px;"></i>  {{ translate('Rating') }} : <span class="text-danger" style="font-size: 14px;">{{ renderStarRating($shop->rating) }}</span> </li>
                            </div>

                            <li class="d-flex">
                                <i class="la la-internet-explorer mr-1" style="font-size: 18px;"></i>
                                 {{translate('Social Media')}} : <span class="text-danger" style="font-size: 14px;">

                                <ul class="text-center text-lg-right ml-2 mt-4 mt-lg-0 social colored list-inline mb-0">
                                    @if ($shop->facebook != null)
                                    <li class="list-inline-item">
                                        <a href="{{ $shop->facebook }}" class="facebook" target="_blank">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                        @endif
                                        @if ($shop->instagram != null)
                                            <li class="list-inline-item">
                                        <a href="{{ $shop->instagram }}" class="instagram" target="_blank">
                                            <i class="lab la-instagram"></i>
                                        </a>
                                    </li>
                                        @endif
                                                @if ($shop->twitter != null)
                                                    <li class="list-inline-item">
                                        <a href="{{ $shop->twitter }}" class="twitter" target="_blank">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                        @endif
                                        @if ($shop->google != null)
                                                <li class="list-inline-item">
                                    <a href="{{ $shop->google }}" class="google-plus" target="_blank">
                                        <i class="lab la-google"></i>
                                      </a>
                                     </li>
                                        @endif
                                        @if ($shop->youtube != null)
                                            <li class="list-inline-item">
                                        <a href="{{ $shop->youtube }}" class="youtube" target="_blank">
                                            <i class="lab la-youtube"></i>
                                        </a>
                                    </li>
                                    @endif
                                </ul>

                            </span>
                        </li>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="container mt-5">
                <div class="row justify-content-center" style="margin: 0 !important">
                    <div class="col-md-8 col-lg-8 mb-4">
                        @if (!empty($shop->gallery))
                            @php
                                $array_string = $shop->gallery;
                                $array_string = str_replace(array( '[', ']' ), '', $array_string);
                            @endphp

                            <div class="sticky-top z-3 row px-3">
                                @php
                                    $photos = explode(',', $array_string);
                                @endphp

                                <div id="slider-container" class="slider">
                                    @foreach ($photos as $key => $photo)
                                    <div class="slide">


                                        <a class="venobox" data-gall="mygallery"  href="{{ uploaded_asset($photo) }}"><img src="{{ uploaded_asset($photo) }}"></a>

{{--                                        <a class="my-image-links" data-gall="myGallery" href="{{ uploaded_asset($photo) }}">--}}

{{--                                            <img src="{{ uploaded_asset($photo) }}" alt="">--}}

{{--                                        </a>--}}
                                    </div>
                                    @endforeach




                                    <div onclick="prev()" >
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                                            <span class="sr-only">Previous</span>
                                        </a>

                                    </div>
                                    <div onclick="next()" >
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

{{--                                        <div onclick="prev()" class="control-prev-btn">--}}
{{--                                            <i class="fas fa-arrow-left"></i>--}}

{{--                                        </div>--}}
{{--                                        <div onclick="next()" class="control-next-btn">--}}
{{--                                            <i class="fas fa-arrow-right"></i>--}}
{{--                                        </div>--}}
                                </div>

                            </div>

                        @endif

                    </div>

                    <div class="col-md-4 col-lg-4 mb-4 ">
                        @if ($shop->latitude != null)
                        <div id="googleMap" style="width:100%;height:350px;"></div>
                        @endif
                    </div>

                </div>
            </div>


            <div class="border-bottom mt-5"></div>
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-0">
                    <ul class="list-inline mb-0 text-center text-lg-left">
{{--                        <li class="list-inline-item ">--}}
{{--                            <a class="text-reset d-inline-block fw-600 fs-15 p-3 @if(!isset($type)) border-bottom border-primary border-width-2 @endif" href="{{ route('shop.visit', $shop->slug) }}">{{ translate('Store Home')}}</a>--}}
{{--                        </li>--}}

                        <li class="list-inline-item ">
                            <a class="text-reset d-inline-block fw-600 fs-15 p-3 @if(isset($type) && $type == 'all-products') border-bottom border-primary border-width-2 @endif" href="{{ route('shop.visit.type', ['slug'=>$shop->slug, 'type'=>'all-products']) }}">{{ translate('All Products')}}</a>
                        </li>

                        <li class="list-inline-item ">
                            <a class="text-reset d-inline-block fw-600 fs-15 p-3 @if(isset($type) && $type == 'top-selling') border-bottom border-primary border-width-2 @endif" href="{{ route('shop.visit.type', ['slug'=>$shop->slug, 'type'=>'top-selling']) }}">{{ translate('Top Selling')}}</a>
                        </li>
                    </ul>
                </div>

{{--                <div class="col-lg-6 order-1 order-lg-0">--}}
{{--       --}}
{{--                </div>--}}
            </div>
        </div>
    </section>

    @if (!isset($type))

        <section class="mb-4">
            <div class="container">
                <div class="text-center mb-4">
                    <h3 class="h3 fw-600 border-bottom">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Featured Products')}}</span>
                    </h3>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="aiz-carousel gutters-10" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-autoplay='true' data-infinute="true" data-dots="true">
                            @foreach ($shop->user->products->where('published', 1)->where('approved', 1)->where('seller_featured', 1) as $key => $product)
                                <div class="carousel-box">
                                    @include('frontend.partials.product_box_1',['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="mb-4">
        <div class="container">
            <div class="mb-4">
                <h3 class="h3 fw-600 border-bottom">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">
                        @if (!isset($type))
                            {{ translate('New Arrival Products')}}
                        @elseif ($type == 'top-selling')
                            {{ translate('Top Selling')}}
                        @elseif ($type == 'all-products')
                            {{ translate('All Products')}}
                        @endif
                    </span>
                </h3>
            </div>
            <div class="row gutters-5 row-cols-xxl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">
                @php
                    if (!isset($type)){
                        $products = \App\Models\Product::where('user_id', $shop->user->id)->where('published', 1)->where('approved', 1)->orderBy('created_at', 'desc')->paginate(24);
                    }
                    elseif ($type == 'top-selling'){
                        $products = \App\Models\Product::where('user_id', $shop->user->id)->where('published', 1)->where('approved', 1)->orderBy('num_of_sale', 'desc')->paginate(24);
                    }
                    elseif ($type == 'all-products'){
                        $products = \App\Models\Product::where('user_id', $shop->user->id)->where('published', 1)->where('approved', 1)->paginate(24);
                    }
                @endphp
                @foreach ($products as $key => $product)
                    <div class="col mb-3">
                        @include('frontend.partials.product_box_1',['product' => $product])
                    </div>
                @endforeach
            </div>
            <div class="aiz-pagination aiz-pagination-center mb-4">
                {{ $products->links() }}
            </div>
        </div>
    </section>


@endsection

@section('script')

    <script>

        function initMap() {

            var latitude = JSON.parse({!! json_encode($shop->latitude) !!});
            var longitude = JSON.parse({!! json_encode($shop->longitude) !!});


            const myLatLng = { lat: latitude, lng: longitude };
            const map = new google.maps.Map(document.getElementById("googleMap"), {
                zoom: 4,
                center: myLatLng,
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Hello World!",
            });
        }

        window.initMap = initMap;



        function prev(){
            document.getElementById('slider-container').scrollLeft -= 270;
        }

        function next()
        {
            document.getElementById('slider-container').scrollLeft += 270;
        }


        // $(".slide img").on("click" , function(){
        //     $(this).toggleClass('zoomed');
        //     $(".overlay").toggleClass('active');
        // })

        $(document).ready(function(){
            $('.venobox').venobox();
            $('.my-video-links').venobox();
            $('.my-video-gallery').venobox();
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC43xc3Qlo5pX_NclD-jvmeG2JP2362eE&callback=initMap"></script>
@endsection



