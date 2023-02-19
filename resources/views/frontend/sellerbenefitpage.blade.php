@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ static_asset('assets/css/benefitpage.css') }}">
@section('content')

    <body>
        <div class="container">

            <section class="">

                <div class="showcase">

                    <div class="row">
                        <div class="col-md-10 ml-auto" style="text-align: right; padding-right: 5%; padding-top: 46px;">
                            <h2 class="text-shadow text-dark" style="font-size: 48px;">
                                {{ translate('seller_benefit_page_main_slider_title') }}</h2>
                            <h4 class="text-shadow text-dark" style="font-size: 32px;">
                                {{ translate('seller_benefit_page_main_slider_desc') }}</h2>
                                <a href="#" class=" btn btn-warning text-white mt-2" style="font-weight: 500;">
                                    {{ translate('seller_benefit_page_main_slider_button') }} <i
                                        class="fas fa-chevron-right"></i>
                                </a>
                        </div>
                    </div>
                </div>

            </section>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-center mt-5 text-secondary">{{ translate('seller_benefit_page_part1_title') }}</h2>
                    <p class="text-center px-5">
                        {{ translate('seller_benefit_page_part1_desc') }}
                    </p>
                </div>

            </div>

            <section>

                <div class="row">
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment1_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment1_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment2_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment2_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment3_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment3_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment4_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment4_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment5_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment5_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment6_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment6_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment7_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment7_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment8_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment8_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm" style="padding-top: 30px; margin-bottom: 0px;">
                        <div class="text-center">
                            <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/icon.png"
                                alt="" class="img">
                            <h4>{{ translate('seller_benefit_page_part2_segment9_title') }}</h4>
                            <p>{{ translate('seller_benefit_page_part2_segment9_desc') }}</p>
                        </div>
                    </div>
                </div>

            </section>
            <!-- timeline start -->
            <section>
                <div class="text-center">
                    <h2 class="text-warning text-bold mt-2">Few Steps to Success</h2>
                    <p>BEST FEES TO START</p>
                </div>
                <section id="conference-timeline">
                    <!-- <div class="timeline-start">Start</div> -->
                    <div class="conference-center-line"></div>
                    <div class="conference-timeline-content">
                        <!-- Article -->
                        <div class="timeline-article">
                            <div class="content-left-container">
                                <div class="content-left">

                                    <h2>{{ translate('seller_benefit_page_part3_segment1_title') }}</h2>
                                    <div class="">
                                        <ul>
                                            <li>{{ translate('seller_benefit_page_part3_segment1_desc') }}</li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                            <div class="content-right-container">
                                <div class="content-right">
                                    <div class="">
                                        <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/6368592.jpg"
                                            alt="" style="width: 300px;height: 300px;">
                                    </div>
                                </div>

                            </div>
                            <div class="meta-date">
                                <span class="date">1</span>
                            </div>
                        </div>
                        <!-- // Article -->

                        <!-- Article -->
                        <div class="timeline-article">
                            <div class="content-left-container">
                                <div class="content-left">
                                    <div class="">
                                        <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/222.jpg"
                                            alt="" style="width: 300px;height: 300px;">
                                    </div>
                                </div>

                            </div>
                            <div class="content-right-container">
                                <div class="content-right">
                                    <h2>{{ translate('seller_benefit_page_part3_segment2_title') }}</h2>
                                    <div class="">
                                        <ul>
                                            <li>{{ translate('seller_benefit_page_part3_segment2_desc') }}</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="meta-date">
                                <span class="date">2</span>
                            </div>
                        </div>
                        <!-- // Article -->

                        <!-- Article -->
                        <div class="timeline-article">
                            <div class="content-left-container">
                                <div class="content-left">

                                    <h2>{{ translate('seller_benefit_page_part3_segment3_title') }}</h2>
                                    <div class="">
                                        <ul>
                                            <li>{{ translate('seller_benefit_page_part3_segment3_desc') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="content-right-container">
                                <div class="content-right">

                                    <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/159267-OURODR-608.jpg"
                                        alt="" style="width: 360px;height: 300px;">

                                </div>

                            </div>
                            <div class="meta-date">
                                <span class="date">3</span>
                            </div>
                        </div>
                        <!-- // Article -->
                        <!-- Article -->
                        <div class="timeline-article">
                            <div class="content-left-container">
                                <div class="content-left">
                                    <div class="">
                                        <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2022/02/8233.jpg"
                                            alt="" style="width: 300px;height: 300px;">
                                    </div>
                                </div>

                            </div>
                            <div class="content-right-container">
                                <div class="content-right">
                                    <h2>{{ translate('seller_benefit_page_part3_segment4_title') }}</h2>
                                    <div class="">
                                        <ul>
                                            <li>{{ translate('seller_benefit_page_part3_segment4_desc') }}</li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="meta-date">
                                <span class="date">4</span>
                            </div>
                        </div>
                        <!-- // Article -->
                    </div>
                    <!-- <div class="timeline-end">End</div> -->
                </section>
            </section>
            <!-- Timeline end -->
            <section>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center">
                            <h1 class="m-2">{{ translate('seller_benefit_page_part4_title') }}</h1>
                            <p>{{ translate('seller_benefit_page_part4_desc') }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row my-4 text-center">
                        <div class=" col-md align-self-center">
                            <div class="border border-3 rounded-circle border-warning text-center w100">
                                <h1>${{ translate('seller_benefit_page_part4_circle1_number') }}
                                </h1>
                                <p> {{ translate('seller_benefit_page_part4_circle1_title') }}</p>
                            </div>
                        </div>
                        <div class="col-md align-self-center">
                            <div class="border border-3 rounded-circle border-warning text-center  w100">
                                <h1>${{ translate('seller_benefit_page_part4_circle2_number') }}
                                </h1>
                                <p> {{ translate('seller_benefit_page_part4_circle2_title') }}</p>
                            </div>
                        </div>
                        <div class="col-md align-self-center">
                            <div class="border border-3 rounded-circle border-warning text-center  w100">
                                <h1>${{ translate('seller_benefit_page_part4_circle3_number') }}
                                </h1>
                                <p> {{ translate('seller_benefit_page_part4_circle3_title') }}</p>
                            </div>
                        </div>
                        <div class=" col-md align-self-center">
                            <div class="border border-3 rounded-circle border-warning text-center w100">
                                <h1>${{ translate('seller_benefit_page_part4_circle4_number') }}
                                </h1>
                                <p> {{ translate('seller_benefit_page_part4_circle4_title') }}</p>
                            </div>
                        </div>
                        <div class="col-md align-self-center">
                            <div class="border border-3 rounded-circle border-warning text-center  w100">
                                <h1>${{ translate('seller_benefit_page_part4_circle5_number') }}
                                </h1>
                                <p> {{ translate('seller_benefit_page_part4_circle5_title') }}</p>
                            </div>
                        </div>
                        <div class="col-md align-self-center">
                            <div class="border border-3 rounded-circle border-warning text-center  w100">
                                <h1>${{ translate('seller_benefit_page_part4_circle6_number') }}
                                </h1>
                                <p> {{ translate('seller_benefit_page_part4_circle6_title') }}</p>
                            </div>
                        </div>

                    </div>

                </div>

                <div>
                    <h5 class="text-center m-5">{{ translate('seller_benefit_page_part5_title') }}</h5>
                    <ul>
                        <li>{{ translate('seller_benefit_page_part5_desc') }}</li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-center m-5">{{ translate('seller_benefit_page_part6_title') }}</h5>
                    <ol>
                        <li>
                            {!! translate('seller_benefit_page_part6_desc', null, true) !!}
                        </li>
                    </ol>
                </div>

            </section>
            <section class="d-flex justify-content-center">
                <div class="links row p-5 w-75">
                    <div class="col-sm-4">
                        <img src="https://aromarket.exportica.net/wp-content/uploads/sites/13/2019/05/vender2.png"
                            alt="">
                    </div>
                    <div class="col-sm-8">
                        <p>{{ translate('seller_benefit_page_part2_segment9_title') }}
                        </p>
                        <p>{{ translate('seller_benefit_page_part2_segment9_desc') }}</p>
                    </div>
                </div>
            </section>
            <section>
                <div class="text-center m-5">
                    <p>FREQUENTLY ASKED QUESTIONS</p>
                    <h4>Here are some common questions about selling on kemetro.com</h4>
                </div>

               
                <div id="main">
                        <div class="container">
                            <div class="accordion" id="faq">
                                        <div class="card">
                                            <div class="card-header" id="faqhead1">
                                                <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1"
                                                aria-expanded="true" aria-controls="faq1" style="color: #000 !important; font-size: 22px; font-weight: 600;">
                                                {{ translate('seller_benefit_page_part6_faq1_title') }}
                                            </a>
                                            </div>
                    
                                            <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
                                                <div class="card-body">
                                                    {{ translate('seller_benefit_page_part6_faq1_answer') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead2">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2"
                                                aria-expanded="true" aria-controls="faq2" style="color: #000 !important; font-size: 22px; font-weight: 600;">
                                                {{ translate('seller_benefit_page_part6_faq2_title') }}
                                            </a>
                                            </div>
                    
                                            <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                                                <div class="card-body">
                                                    {{ translate('seller_benefit_page_part6_faq2_answer') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="faqhead3">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3"
                                                aria-expanded="true" aria-controls="faq3" style="color: #000 !important; font-size: 22px; font-weight: 600;">{{ translate('seller_benefit_page_part6_faq3_title') }}</a>
                                            </div>
                    
                                            <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                                                <div class="card-body">
                                                    {{ translate('seller_benefit_page_part6_faq3_answer') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="faqhead4">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq4"
                                                aria-expanded="true" aria-controls="faq4" style="color: #000 !important; font-size: 22px; font-weight: 600;">
                                                {{ translate('seller_benefit_page_part6_faq4_title') }}
                                            </a>
                                            </div>
                    
                                            <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                                                <div class="card-body">
                                                    {{ translate('seller_benefit_page_part6_faq4_answer') }}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card">
                                            <div class="card-header" id="faqhead5">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq5"
                                                aria-expanded="true" aria-controls="faq5" style="color: #000 !important; font-size: 22px; font-weight: 600;">
                                                {{ translate('seller_benefit_page_part6_faq5_title') }}
                                            </a>
                                            </div>
                    
                                            <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
                                                <div class="card-body">
                                                    {{ translate('seller_benefit_page_part6_faq5_answer') }}
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                </div>
              

            </section>
            <hr>
            <section>
                <div class="text-center">
                    <h1>Still have more questions? Feel free to contact us.</h1>
                    <button class="btn btn-warning m-5">{{ translate('contact_us') }}</button>
                    <h1 class="text-success">Register Seller account now</h1>
                </div>
                <div class="d-flex justify-content-center m-5">
                    <a href="{{ route('user.login') }}"
                        class="d-inline-block py-2 px-3 mr-3 btn btn-warning">{{ translate('Login') }}</a>
                    <a href="{{ route('user.registration') }}"
                        class="d-inline-block py-2 btn btn-warning">{{ translate('Registration') }}</a>
                </div>
            </section>

        </div>

    </body>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
