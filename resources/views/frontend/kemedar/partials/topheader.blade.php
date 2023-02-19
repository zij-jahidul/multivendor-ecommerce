
<!-- kemedar top header css start -->
<link rel="stylesheet" href="{{ static_asset('kemedar/css/style.css') }}">
<!-- kemedar top header css end -->

<!-- kemedar top header fixed end -->
    <!-- top bar starts -->
    <div class="topbar-container">
        <div class="top-nav">
            <!-- left side buttons starts -->
            <div class="left-nav-top">
                <button class="top-btn btn-active" onmouseenter="Kemeshow()" onmouseleave="Kemehide()">
                    <img src="{{ static_asset('kemedar/images/btn1.ico') }}" alt="">
                    <span>Kemedar</span>

                </button>
                <div class="custom-tooltip" id="keme-dev">
                    <p style="font-weight:normal !important;">
                        In Kemedar you can enjoy many services completely free of charge.
                        You can sell or buy real estate and hire workers for free in a very easy
                        and simple way and directly contact the seller, buyer or specialist technician.
                        Specialized programs and many benefits for all those interested in real estate,
                        such as agents, real estate developers, craftsmen and finishing companies,
                        as well as freelancer marketers and investors in the real estate field.
                        And thanks our network of representatives covering all areas of the countries
                        in which we operate, we can help you check, review, verify and secure your deal
                        and also finish, furnish and invest your properties in the best way.
                    </p>
                </div>
                <button class="top-btn btn2" onmouseenter="ketroshow()" onmouseleave="ketrohide()">
                    <img src="{{ static_asset('kemedar/images/btn2.ico') }}" alt="">
                    <span>Kemmetro</span>

                </button>
                <div class="custom-tooltip" id="ketro-dev">
                    <p>
                        Kemetro is the e-commerce portal of Kemedar and is the first portal of
                        its kind that specializes only in selling high quality home building and
                        finishing products. You can find and order everything you need for your home
                        from cement to furniture in one place which makes Kemetro Gate very unique.
                        Our customers can compare a wide range of products from thousands of manufacturers
                        and distributors and get the best prices with a complete satisfaction guarantee
                        that we offer exclusively to Kemetro customers.
                    </p>
                </div>
                <button class="top-btn btn3" onmouseenter="kemetashow()" onmouseleave="kemetahide()">
                    <img src="{{ static_asset('kemedar/images/btn3.ico') }}" alt="">
                    <span>Kemmeta</span>

                </button>
                <div class="custom-tooltip2" id="kemeta-dev">
                    <p>
                        Kemmeta Community is the first social network dedicated to the real
                        estate sector and connects all people interested in real estate from
                        all over the world such as sellers, buyers, investors, advertisers,
                        employees, job seekers, contractors, developers, agents, .....etc.
                        You can enjoy connecting people with the same interests and creating
                        your perfect network in the first dedicated real estate community
                    </p>
                </div>
                <button class="top-btn btn4" onmouseenter="kemnewsshow()" onmouseleave="kemnewshide()">
                    <img src="{{ static_asset('kemedar/images/btn4.ico') }}" alt="">
                    <span>Kemenews</span>

                </button>
                <div class="custom-tooltip2" id="kemnews-dev">
                    <p>
                        Any decision you make in the real estate industry must be based on true
                        information from reliable sources. From this standpoint, we set out in Kemedar
                        to gather the most important and reliable news for our visitors so that they
                        can take the right decision at the right time. Reliable news from a network of
                        our representatives on the ground that is one of the strongest networrk in its field.
                    </p>
                </div>
                <button class="top-btn btn5" onmouseenter="kemacdshow()" onmouseleave="kemacdhide()">
                    <img src="{{ static_asset('kemedar/images/btn5.ico') }}" alt="">
                    <span>Kemedar Academy</span>

                </button>
                <div class="custom-tooltip3" id="kemacd-dev">
                    <p>
                        Kemedar Academy is a non-profit organization whose goal is to raise the technical
                        and professional level of all those working in the real estate industry,
                        from craftsmen and technicians to marketers and Freelancers. There are also
                        specialized programs for real estate agents and investors. Professional volunteers
                        with great experience who like to give their experiences to benefit others, free of
                        charge for the Academy's students.. Specialized programs for training children and
                        youth.
                    </p>
                </div>
                <button class="top-btn btn6" onmouseenter="kemreitshow()" onmouseleave="kemreithide()">
                    <img src="{{ static_asset('kemedar/images/btn6.ico') }}" alt="">
                    <span>Kemedar Reit</span>

                </button>
                <div class="custom-tooltip3" id="kemreit-dev">
                    <p>
                        KEMEDAR REIT investment portal is specialized in organizing the whole processing of Real estate
                        generating monthly income. Our investors are just interested to buy a property that generates
                        monthly or annual income, not in investment by resale of this property
                    </p>
                </div>

            </div>
            <!-- left side buttons ends -->

            <!-- right side buttons starts -->
            <div class="right-nav-top">
                <ul>
                    <li onmouseenter="langugedivshow()" onmouseleave="langugedivhide()">
                        <img src="{{ static_asset('kemedar/images/language.png')  }}" alt="">
                    </li>
                    <li onmouseenter="countryDivshow()" onmouseleave="countryDivhide()">
                        <img src="{{ static_asset('kemedar/images/country.png') }}" alt="">
                    </li>
                    <li onmouseenter="curunceyDivshow()" onmouseleave="curunceyDivhide()">
                        <img src="{{ static_asset('kemedar/images/124.png') }}" alt="">
                    </li>
                    <li onmouseenter="benefitDivshow()" onmouseleave="benefitDivhide()">
                        <img src="{{ static_asset('kemedar/images/user-benefits.png') }}" alt="">
                    </li>
                    <li onmouseenter="aboutDivshow()" onmouseleave="aboutDivhide()">
                        <img src="{{ static_asset('kemedar/images/about-us.png') }}" alt="">
                    </li>
                    <li onmouseenter="contactDivshow()" onmouseleave="contactDivhide()">
                        <img src="{{ static_asset('kemedar/images/call.png') }}" alt="">
                    </li>
                    <li onmouseenter="loginDivshow()" onmouseleave="loginDivhide()">
                        <img src="{{ static_asset('kemedar/images/login.png') }}" alt="">
                    </li>
                    <li onclick="signupmodelDivshow()">
                        <img src="{{ static_asset('kemedar/images/signup.png') }}" alt="">
                    </li>
                </ul>
                <!-- dropdowns right side starts -->
                <!-- language drop-down starts -->
                @if(get_setting('show_language_switcher') == 'on')
                <div class="lang-div" id="languge-div"  onmouseenter="langugedivshow()" onmouseleave="langugedivhide()">
                        <li class="list-inline-item dropdown mr-3" id="lang-change">
                            @php
                                if(Session::has('locale')){
                                    $locale = Session::get('locale', Config::get('app.locale'));
                                }
                                else{
                                    $locale = 'en';
                                }
                            @endphp
                            <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="mr-2 lazyload" alt="{{ \App\Models\Language::where('code', $locale)->first()->name }}" height="11">
                                <span class="opacity-60">{{ \App\Models\Language::where('code', $locale)->first()->name }}</span>
                            </a>
                            <ul class="dropdown-menu ">
                                @foreach (\App\Models\Language::where('status', 1)->get() as $key => $language)
                                    <li>
                                        <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">
                                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                            <span class="language">{{ $language->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                </div>
                @endif
                <!-- language drop-down ends -->

                <!-- country drop down starts -->
                <div class="country-div" id="countryDiv" onmouseenter="countryDivshow()"
                    onmouseleave="countryDivhide()">
                    <div class="country-group-div">
                        <span class="country-group-span">Africa</span>
                        <ul>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/eg.png') }}" alt="">
                                    <span>Egypt</span>
                                </a>
                            </li>
                            <li class="country-right-li">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/ma.png') }}" alt="">
                                    <span>Morocco</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="country-group-div">
                        <span class="country-group-span">Europe</span>
                        <ul>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/tr.png') }}" alt="">
                                    <span>Turkey</span>
                                </a>
                            </li>
                            <li class="" style=" margin-left: 65px !important;">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/ru.png') }}" alt="">
                                    <span>Russia</span>
                                </a>
                            </li>
                            <br>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/ua.png') }}" alt="">
                                    <span>Ukraine</span>
                                </a>
                            </li>
                            <li class="" style=" margin-left: 59px !important;">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/de.png') }}" alt="">
                                    <span>Germany</span>
                                </a>
                            </li>
                            <br>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/it.png') }}" alt="">
                                    <span>Italy</span>
                                </a>
                            </li>
                            <li class="" style=" margin-left: 81px !important;">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/es.png') }}" alt="">
                                    <span>Spain</span>
                                </a>
                            </li>
                            <br>


                        </ul>
                    </div>
                    <div class="country-group-div">
                        <span class="country-group-span">Asia</span>
                        <ul>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/ae.png') }}" alt="">
                                    <span>UAE</span>
                                </a>
                            </li>
                            <li class="" style=" margin-left: 85px !important;">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/sa.png') }}" alt="">
                                    <span>Saudi Arabia</span>
                                </a>
                            </li>
                            <br>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/id.png') }}" alt="">
                                    <span>Indonesia</span>
                                </a>
                            </li>
                            <li class="" style=" margin-left: 46px !important;">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/vn.png') }}" alt="">
                                    <span>Vietnam</span>
                                </a>
                            </li>
                            <br>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/qa.png') }}" alt="">
                                    <span>Qatar</span>
                                </a>
                            </li>
                            <li class="country-right-li">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/kw.png') }}" alt="">
                                    <span>Kuwait</span>
                                </a>
                            </li>
                            <br>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/om.png') }}" alt="">
                                    <span>Oman</span>
                                </a>
                            </li>
                            <li class="" style=" margin-left: 65px !important;">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/pk.png') }}" alt="">
                                    <span>Pakistan</span>
                                </a>
                            </li>
                            <br>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/bd.png') }}" alt="">
                                    <span>Bangladesh</span>
                                </a>
                            </li>
                            <li class="" style=" margin-left: 31px !important;">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/in.png') }}" alt="">
                                    <span>India</span>
                                </a>
                            </li>
                            <br>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/cn.png') }}" alt="">
                                    <span>China</span>
                                </a>
                            </li>
                            <li class="country-right-li">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/th.png') }}" alt="">
                                    <span>Thailand</span>
                                </a>
                            </li>
                            <br>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/jp.png') }}" alt="">
                                    <span>Japan</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="country-group-div">
                        <span class="country-group-span">USA</span>
                        <ul>
                            <li class="">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/us.png') }}" alt="">
                                    <span>USA</span>
                                </a>
                            </li>
                            <li class="" style=" margin-left: 80px !important;">
                                <a href="">
                                    <img src="{{ static_asset('kemedar/images/24/br.png') }}" alt="">
                                    <span>Brazil</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- country drop down ends -->

                <!-- currncy drop down starts -->
                @if(get_setting('show_currency_switcher') == 'on')
                <div class="currncy-div" id="curunceyDiv" onmouseenter="curunceyDivshow()" onmouseleave="curunceyDivhide()">
                    <li class="list-inline-item dropdown ml-auto ml-lg-0 mr-0" id="currency-change">
                    <ul id="curncey-menu">

                        @php
                            if(Session::has('currency_code')){
                                $currency_code = Session::get('currency_code');
                            }
                            else{
                                $currency_code = \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code;
                            }
                        @endphp
                        <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2 opacity-60" data-toggle="dropdown" data-display="static">
                            {{ \App\Models\Currency::where('code', $currency_code)->first()->name }} {{ (\App\Models\Currency::where('code', $currency_code)->first()->symbol) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                            @foreach (\App\Models\Currency::where('status', 1)->get() as $key => $currency)
                                <li>
                                    <a class="dropdown-item @if($currency_code == $currency->code) active @endif" href="javascript:void(0)" data-currency="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->symbol }})</a>
                                </li>
                            @endforeach
                        </ul>
                    </ul>
                    </li>
                </div>
                @endif
                <!-- currncy drop down ends -->

                <!-- user benefits dropdown starts -->
                <div class="benefit-div" id="benefitDiv" onmouseenter="benefitDivshow()"
                    onmouseleave="benefitDivhide()">
                    <div>
                        <span class="active-span">User Benefits</span>
                    </div>
                    <ul class="benefit-list" style="margin-top:20px !important;">
                        <li>
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-01.png') }}" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Property Seller</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-01.png') }}" class="img-fluid" alt="">
                            </i>

                            <a href="">
                                <span>Property Buyer</span>
                            </a>
                        </li>
                        <li class="brn">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-02.png') }}" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Product Seller</span>
                            </a>
                        </li>
                        <br>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-03.png') }}" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Product Buyer</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-04.png') }}" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Store Collaborator</span>
                            </a>
                        </li>
                        <li class="brn">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-05.png') }}" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Product Shipper</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-06.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/carpenter.html">
                                <span>Real estate Agent</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-07.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/lawyer.html">
                                <span>Real estate Developer</span>
                            </a>
                        </li>
                        <li class="brn">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-08.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/decorist.html">
                                <span>Handyman or Technician</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-18.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/painter.html">
                                <span>Finishing Company</span>
                            </a>
                        </li>

                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-11.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/carpenter.html">
                                <span>Investor</span>
                            </a>
                        </li>
                        <li class="brn" style="color:#000 !important;">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-12.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/lawyer.html">
                                <span>Affiliate Marketer</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-13.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/decorist.html">
                                <span>Freelancer</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-14.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/painter.html">
                                <span>Job Seeker</span>
                            </a>
                        </li>
                        <li class="brn">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-15.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/floor_worker.html">
                                <span>Kemmeta community member</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-16.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="">
                                <span>Trainer or Instructor</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('kemedar/images/register/Icon-17.png') }}" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/carpenter.html">
                                <span>Academy Student</span>
                            </a>
                        </li>
                    </ul>

                </div>


                <!-- user benefits dropdown ends -->
                <!-- about us dropdown starts -->
                <div class="benefit-div" id="aboutDiv" onmouseenter="aboutDivshow()" onmouseleave="aboutDivhide()">
                    <div>
                        <span class="active-span">About Us</span>
                    </div>
                    <ul class="benefit-list" style="margin-top:20px !important;">
                        <li>

                            <a href="">
                                <span>Mission</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">


                            <a href="">
                                <span>President Message</span>
                            </a>
                        </li>
                        <li class="brn">

                            <a href="">
                                <span>Our Business Model</span>
                            </a>
                        </li>
                        <br>
                        <li class="">

                            <a href="">
                                <span>Business Strategy</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Our Beautiful Minds</span>
                            </a>
                        </li>
                        <li class="brn">

                            <a href="">
                                <span>Our Main Brands</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="l">
                                <span>Products & Services</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">

                            <a href="">
                                <span>What is new in Kemedar</span>
                            </a>
                        </li>
                        <li class="brn">

                            <a href="">
                                <span>Kemedar in Numbers</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Our users Groups</span>
                            </a>
                        </li>

                        <li class="">

                            <a href="hire-technician/carpenter.html">
                                <span>Why We are Different?</span>
                            </a>
                        </li>
                        <li class="brn" style="color:#000 !important;">

                            <a href="">
                                <span>Our companies</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Our Offices</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>What is Proptech?</span>
                            </a>
                        </li>
                        <li class="brn">

                            <a href="">
                                <span>Opportunities in Proptech</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Proptech in Numbers</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Alternative Living</span>
                            </a>
                        </li>
                        <li class="brn">

                            <a href="">
                                <span>Buy-Sale Transaction</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Managment & Construction</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Dataroom For Investors</span>
                            </a>
                        </li>
                        <li class="brn">

                            <a href="">
                                <span>Videos & Media</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Our Main Systems</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Contact Us</span>
                            </a>
                        </li>
                        <li class="brn">

                            <a href="">
                                <span>Coverd Countries</span>
                            </a>
                        </li>
                        <li class="">

                            <a href="">
                                <span>Stats Map</span>
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- about us dropdown ends -->


                <!-- contat us dropdown starts -->
                <div class="contact-div" id="contactDiv" onmouseenter="contactDivshow()"
                    onmouseleave="contactDivhide()">
                    <div class="span-div">
                        <span class="active-span btn-active span-div">We are here for you</span>
                    </div>
                    <ul>
                        <li class="" style="color:#000 !important;">

                            <i class="icon-phone-call"></i>

                            <a href="">
                                <span>Phone Call:+18506770727</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-chat-withus"></i>
                            <a href="">
                                <span>Chat with us</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-chat-voice"></i>
                            <a href="">
                                <span>Voice Chat</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-video-chat"></i>
                            <a href="">
                                <span>Video Chat</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-email"></i>
                            <a href="">
                                <span>Email</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-feedback"></i>
                            <a href="">
                                <span>Feedback</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-whatsapp"></i>
                            <a href="">
                                <span>Whatsapp</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-viber"></i>
                            <a href="">
                                <span>Viber</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-skype"></i>
                            <a href="">
                                <span>Skype</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-telegram"></i>
                            <a href="">
                                <span>Telegram</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-messenger"></i>
                            <a href="">
                                <span>Messenger</span>
                            </a>
                        </li>
                        <li class="" style="color:#000 !important;">
                            <i class="icon-call-me-back"></i>
                            <a href="">
                                <span>Call me back</span>
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- contat us dropdown ends -->

                <!-- login drop down starts -->
                <div class="login-div" id="loginDiv" onmouseenter="loginDivshow()" onmouseleave="loginDivhide()">
                    <form action="" method="POST" id="login">
                    <div class="">
                        <span class="active-span ">Login Here</span>
                    </div>

                    <div class="input-div">
                        <label for="" class="input-lable">Email Address/Phone Number</label>
                        <input type="text" id="login" class="login-form" placeholder="Please Enter Your Email or Phone Number">
                    </div>
                    <div class="input-div">
                        <label for="" class="input-lable">Password</label>
                        <input type="password" class="login-form" placeholder="Please Enter Your Password">
                    </div>
                    <button class="btn-login" id="btn-login" type="submit">Login</button>
                    </form>
                    <h6 class="text-login"> Or Login with</h6>
                    <div class="social-login-div">
                        <span>
                            <i class="fa fa-linkedin"></i>
                        </span>
                        <a href="">Linkedin</a>
                        <span>
                            <i class="fa fa-twitter"></i>
                        </span>
                        <a href="">Twitter</a>
                        <span>
                            <i class="fa fa-facebook"></i>
                        </span>
                        <a href="">Facebook</a>
                        <span>
                            <i class="fa fa-google" style="color: #dc3545 !important; font-size: 13px;"></i>
                        </span>
                        <a href="">Google</a>
                    </div>
                    <p class="login-last-line"> Have not an account?
                        <span class="">
                            <a href="">Signup</a>
                        </span>
                    </p>
                </div>
                <!-- login drop down ends -->

                <!-- dropdowns right side end -->
            </div>
            <!-- right side buttons starts -->
        </div>
    </div>
    <!-- top bar ends -->

    <!-- sidebar starts -->
    <div class="sidebar-kemedar">
        <ul class="first-menu-sidebar">
            <li>
                <img src="{{ static_asset('kemedar/images') }}/kemepay-iconsvg.svg" alt="" onmouseenter="kempaylogoShow()"
                    onmouseleave="kempaylogoHide()">
                <a class="logo-div" href="" id="logoDiv" onmouseenter="kempaylogoToolShow()"
                    onmouseleave="kempaylogoToolHide()">
                    <img src="{{ static_asset('kemedar/images') }}/kemepay-01.82da9378.ico" alt="">
                </a>
                <div class="custom-tooltip logo-tooltip" id="tooltipDiv">
                    <p style="font-weight:normal !important;">
                        KemePay is a complete system of payment processing that gives peace of mind
                        to all users of all our systems to track all their payments, transactions,
                        deposits, orders, and wallets very easily in one place
                    </p>
                </div>
            </li>

            <li>
                <img src="{{ static_asset('kemedar/images') }}/kemedar-shiping-iconsvg.svg" alt="" onmouseenter="kemeshipLogoShow()"
                    onmouseleave="kemeshipLogoHide()">
                <a class="logo-div" id="kemeshipLogo" onmouseenter="kemeshipLogoToolShow()"
                    onmouseleave="kemeshipLogoToolHide()">
                    <img src="{{ static_asset('kemedar/images') }}/kemeshipping-01.cc608cff.ico" alt="">
                </a>
                <div class="custom-tooltip logo-tooltip" id="kemeshipTooltip">
                    <p style="font-weight:normal !important;">
                        Kemedar shipping is a special system developed especially to manage
                        all shipping operations of Kemetro products. All shippers and shipping
                        companies can register here to provide shipping service to all sellers
                        in Kemetro
                    </p>
                </div>
            </li>

            <li>
                <img src="{{ static_asset('kemedar/images') }}/Businessmanager-icon.svg" alt="" onmouseenter="kembusinessLogoShow()"
                    onmouseleave="kembusinessLogoHide()">
                <a class="logo-div" id="kembusinessLogo" onmouseenter="kembusinessLogoToolShow()"
                    onmouseleave="kembusinessLogoToolHide()">
                    <img src="{{ static_asset('kemedar/images') }}/Businessmanager01.a2406750.ico" alt="">
                </a>
                <div class="custom-tooltip logo-tooltip" id="kembusinessTooltip">
                    <p style="font-weight:normal !important;">
                        Kemedar Business manager
                        Based on real business needs and requirements for real estate and construction business
                        Our kemedar business management system provides companies with the tools and services to make it
                        easy to manage, promote and grow your
                        business
                    </p>
                </div>
            </li>

            <li>
                <img src="{{ static_asset('kemedar/images') }}/KemedarAds-icon.svg" alt="" onmouseenter="kemadsLogoShow()"
                    onmouseleave="kemadsLogoHide()">
                <div class="logo-div" id="kemadsLogo" onmouseenter="kemadsLogoToolShow()"
                    onmouseleave="kemadsLogoToolHide()">
                    <img src="{{ static_asset('kemedar/images') }}/Adlogo-01.7e0b6187.ico" alt="">
                </div>
                <div class="custom-tooltip logo-tooltip" id="kemadstooltip">
                    <p style="font-weight:normal !important;">
                        KEMEDAR ad is a customized and sophisticated advertising system to make it easy
                        to buy ads spaces on pages of Kemedar websites and systems. By a few simple
                        clicks, you can buy and design the ad space select a specific region or area,
                        specific category or price, as well as Calculation either by the number of ad
                        views, clicks, or days viewed. All process is 100% online and you pay instantly
                        without the need to make any contacts or discussions that may waste your time.
                    </p>
                </div>
            </li>
            <li>
                <img src="{{ static_asset('kemedar/images') }}/KemedarAffiliate-iconsvg.svg" alt="" onmouseenter="affiliateLogoShow()"
                    onmouseleave="affiliateLogoHide()">
                <div class="logo-div" id="affiliateLogo" onmouseenter="affiliateLogoToolShow()"
                    onmouseleave="affiliateLogoToolHide()">
                    <img src="{{ static_asset('kemedar/images') }}/Affiliatelogo.ico" alt="">
                </div>
                <div class="custom-tooltip logo-tooltip" id="affiliateTooltip">
                    <p style="font-weight:normal !important;">
                        Kemedar Affiliate:
                        An integrated system for managing affiliate marketers makes us
                        employ thousands of them very effectively. We will teach you all
                        the skills and give you everything you need to be a professional
                        Real Estate Marketer! We will provide you with all the tools to
                        help you perform your job and be with you step by step.
                    </p>
                </div>
            </li>
        </ul>
        <ul class="first-menu-sidebar">
            <li>
                <a href="" onmouseenter="chHomeToggle()" onmouseleave="chHomeHide()">
                    <i class="fa fa-exchange"></i>

                </a>
                <div class="smalltooltip" id="chHome">
                    <div class="triangle"></div>

                    <p>Change Homepage Style</p>
                </div>
            </li>
            <li>
                <a href="" onmouseenter="homeTooltipToggle()" onmouseleave="homeTooltipHide()">
                    <i class="fa fa-home"></i>
                </a>
                <div class="smalltooltip" id="homeTooltip">
                    <div class="triangle"></div>

                    <p>Home</p>
                </div>
            </li>
            <li onmouseenter="topSubmenuShow()" onmouseleave="topSubmenuHide()">
                <a href="">
                    <i class="fa fa-align-justify"></i>
                </a>

            </li>
            <div class="footer-menu" >
                <ul class="outter-menu" id="topSubmenu" onmouseenter="topSubmenuShow()" onmouseleave="topSubmenuHide()">
                    <li  onmouseenter="findSubMenuShow()" onmouseleave="findSubMenuHide()">
                        <a href="">
                            Find
                        </a>
                        <div class="footer-menu inner-div" id="findSubMenu"   >
                            <ul class="outter-menu">
                                <li  onmouseenter="propertiesSubMenuShow()" onmouseleave="propertiesSubMenuHide()">
                                    <a href="">
                                        Properties
                                    </a>
                                    <div class="footer-menu inner-div" id="propertiesSubMenu"
                            onmouseenter="propertiesSubMenuShow()" onmouseleave="propertiesSubMenuHide()">
                                    <ul class="outter-menu">
                                        <li>
                                            <a href="">
                                            For Sale
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            For Sale or Rent
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            For Rent
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            For Daily Booking
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            Kemedar Reits in Auction System
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                </li>

                                <li onmouseenter="handymanSubMenuShow()" onmouseleave="handymanSubMenuHide()">
                                    <a href="">
                                        Handyman & Technician
                                    </a>
                                    <div class="footer-menu inner-div" id="handymanSubMenu"
                                    onmouseenter="handymanSubMenuShow()" onmouseleave="handymanSubMenuHide()" >
                                        <ul class="outter-menu" >
                                            <li>
                                                <a href="">
                                                    Tasker Categories
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <a href="">
                                        Projects & Compunds
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Agents
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Developers
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Finishing Companies
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Frenchise Owner
                                    </a>
                                </li>
                                <li onmouseenter="productSubMenuShow()" onmouseleave="productSubMenuHide()">
                                    <a href="">
                                        Products
                                    </a>
                                    <div class="footer-menu inner-div" id="productSubMenu"
                                onmouseenter="productSubMenuShow()" onmouseleave="productSubMenuHide()" >
                                    <ul class="outter-menu" >
                                        <li>
                                            <a href="">
                                                Construction
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            Manosry Material
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            Architectural
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            Electical
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            Plumbing
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Mechanical
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Appliances
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            Furniture
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            Decorative
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                            Landscape & Garden
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                </li>

                                <li>
                                    <a href="">
                                        Product Sellers
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Job or Career
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Instructor
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Training Course
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li onmouseenter="addSubmenuShow()" onmouseleave="addSubmenuHide()">
                        <a href="">
                            Add
                        </a>
                        <div class="footer-menu inner-div" id="addSubmenu" onmouseenter="addSubmenuShow()" onmouseleave="addSubmenuHide()">
                            <ul class="outter-menu">
                                <li>
                                    <a href="">
                                        Property
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Buy Request
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Project
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Investment Opportunity
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Store
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Product
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Post
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Page
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Group
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Evant
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Used Product
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Video News
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Article News
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Course
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li  onmouseenter="investsubmenuShow()" onmouseleave="investsubmenuHide()">
                        <a href="">
                            Invest
                        </a>
                        <div class="footer-menu inner-div" id="investsubmenu"  onmouseenter="investsubmenuShow()" onmouseleave="investsubmenuHide()" >
                            <ul class="outter-menu">
                                <li>
                                    <a href="">
                                        Invest my real estate
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Invest in Kemedar Reits
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Find Investment Oppertunity
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Buy Stock in real Company
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Crowd  Investment
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Venture Investment
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Invest in startup
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Angel  Investment
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li  onmouseenter="connectsubmenuShow()" onmouseleave="connectsubmenuHide()">
                        <a href="">
                            Connect
                        </a>
                        <div class="footer-menu inner-div" id="connectsubmenu"  onmouseenter="connectsubmenuShow()" onmouseleave="connectsubmenuHide()" >
                            <ul class="outter-menu">
                                <li>
                                    <a href="">
                                        News Feed
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Find Friend
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Groups
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Pages
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Fourms
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li onmouseenter="knowsubmenuShow()" onmouseleave="knowsubmenuHide()">
                        <a href="">
                            Know
                        </a>
                        <div class="footer-menu inner-div" id="knowsubmenu" onmouseenter="knowsubmenuShow()" onmouseleave="knowsubmenuHide()" >
                            <ul class="outter-menu">
                                <li>
                                    <a href="">
                                        Recent News
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Trending News
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Reports
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Real estate market news
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Real estate investment
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Governmental & Legal News
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Auction & Trenders
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li onmouseenter="learnsubmenuShow()" onmouseleave="learnsubmenuHide()">
                        <a href="">
                            Learn
                        </a>
                        <div class="footer-menu inner-div" id="learnsubmenu" onmouseenter="learnsubmenuShow()" onmouseleave="learnsubmenuHide()" >
                            <ul class="outter-menu">
                                <li onmouseenter="consubmenuShow()" onmouseleave="consubmenuHide()">
                                    <a href="">
                                        Construction
                                    </a>
                                    <div class="footer-menu inner-div" id="consubmenu" onmouseenter="consubmenuShow()" onmouseleave="consubmenuHide()" >
                                        <ul class="outter-menu">
                                            <li>
                                                <a href="">
                                                    Construction Worker
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Brick Mason
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Construction
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Surveyor
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Conceret finsher
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Ironworker
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Crane operater
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>


                                <li onmouseenter="homdevsubmenuShow()" onmouseleave="homdevsubmenuHide()">
                                    <a href="">
                                    Home Development & Finishing
                                    </a>
                                    <div class="footer-menu inner-div" id="homdevsubmenu" onmouseenter="homdevsubmenuShow()" onmouseleave="homdevsubmenuHide()" >
                                        <ul class="outter-menu">
                                            <li>
                                                <a href="">
                                                Home Design Archetict
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                Painter
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Plumber
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Electrician
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Flooring
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Tile Setter
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Roofer
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Carpenter
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Glazier
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li onmouseenter="rebsubmenuShow()" onmouseleave="rebsubmenuHide()">
                                    <a href="">
                                    Real Estate Business
                                    </a>
                                    <div class="footer-menu inner-div" id="rebsubmenu" onmouseenter="rebsubmenuShow()" onmouseleave="rebsubmenuHide()" >
                                        <ul class="outter-menu">
                                            <li>
                                                <a href="">
                                                Managment
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                Communications
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Business Strategy
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    Real Estate Marketing
                                                </a>
                                            </li>



                                        </ul>
                                    </div>
                                </li>

                                <li onmouseenter="homdecosubmenuShow()" onmouseleave="homdecosubmenuHide()">
                                    <a href="">
                                    Home Decoration & homestyle
                                    </a>
                                    <div class="footer-menu inner-div" id="homdecosubmenu"
                                    onmouseenter="homdecosubmenuShow()" onmouseleave="homdecosubmenuHide()" >
                                        <ul class="outter-menu">
                                            <li>
                                                <a href="">
                                                Home Decoration
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                Do it Yourself
                                                </a>
                                            </li>




                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li  onmouseenter="pssubmenuShow()" onmouseleave="pssubmenuHide()">
                        <a href="">
                            Paid Services
                        </a>
                        <div class="footer-menu inner-div" id="pssubmenu"  onmouseenter="pssubmenuShow()" onmouseleave="pssubmenuHide()" >
                            <ul class="outter-menu">
                                <li>
                                    <a href="">
                                    Subscriptions
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Asdvertising Services
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Promotional Services
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Legal Services
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Professional Services
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Other Services
                                    </a>
                                </li>



                            </ul>
                        </div>
                    </li>

                    <li onmouseenter="ubsubmenuShow()" onmouseleave="ubsubmenuHide()">
                        <a href="">
                            User Benefits
                        </a>
                        <div class="footer-menu inner-div" id="ubsubmenu" onmouseenter="ubsubmenuShow()" onmouseleave="ubsubmenuHide()" >
                            <ul class="outter-menu">
                                <li>
                                    <a href="">
                                    Property Seller
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Property Buyer
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Product Seller
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Product Buyer
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Store Collaborator
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Product Shipper
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Real estate agent
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        Real estate developer
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Handyman or Technician
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Finishing Company
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Investor
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Affiliate Marketer
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Freelancer
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Job Seeker
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Kemmeta community member
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Trainer or Instructor
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    Academy Student
                                    </a>
                                </li>



                            </ul>
                        </div>
                    </li>

                    <li onmouseenter="masubmenuShow()" onmouseleave="masubmenuHide()">
                        <a href="">
                            Mobile Apps
                        </a>
                        <div class="footer-menu inner-div" id="masubmenu" onmouseenter="masubmenuShow()" onmouseleave="masubmenuHide()" >
                            <ul class="outter-menu">
                                <li onmouseenter="kemAppsubmenuShow()" onmouseleave="kemAppsubmenuHide()">
                                    <a href="">
                                    Kemedar
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="kemAppsubmenu" onmouseenter="kemAppsubmenuShow()" onmouseleave="kemAppsubmenuHide()" >
                                    <h5>
                                        GET THE MOBILE APP
                                    </h5>
                                    <div class="app-link">
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/google-play.svg"   alt="">

                                        </a>
                                        <span>OR</span>
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/app-store.svg" width=" alt="">

                                        </a>
                                    </div>
                                    </div>
                                </li>

                                <li onmouseenter="kemetAppsubmenuShow()" onmouseleave="kemetAppsubmenuHide()">
                                    <a href="">
                                    Kemmeta
                                    </a>
                                    <div class="footer-menu inner-div app-div" id="kemetAppsubmenu" onmouseenter="kemetAppsubmenuShow()" onmouseleave="kemetAppsubmenuHide()" >
                                        <h5>
                                        GET THE MOBILE APP
                                        </h5>
                                        <div class="app-link">
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/google-play.svg" width="75px"  alt="">

                                        </a>
                                        <span>OR</span>
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/app-store.svg" width="65px" alt="">

                                        </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="kemetroAppsubmenuShow()" onmouseleave="kemetroAppsubmenuHide()">
                                    <a href="">
                                    Kemetro
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="kemetroAppsubmenu" onmouseenter="kemetroAppsubmenuShow()" onmouseleave="kemetroAppsubmenuHide()">
                                        <h5>
                                        GET THE MOBILE APP
                                        </h5>
                                        <div class="app-link">
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/google-play.svg" width="75px"  alt="">

                                        </a>
                                        <span>OR</span>
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/app-store.svg" width="65px" alt="">

                                        </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="newsAppsubmenuShow()" onmouseleave="newsAppsubmenuHide()">
                                    <a href="">
                                        Kemedar News
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="newsAppsubmenu" onmouseenter="newsAppsubmenuShow()" onmouseleave="newsAppsubmenuHide()">
                                        <h5>
                                        GET THE MOBILE APP
                                        </h5>
                                        <div class="app-link">
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/google-play.svg" width="75px"  alt="">

                                        </a>
                                        <span>OR</span>
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/app-store.svg" width="65px" alt="">

                                        </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="kemacAppsubmenuShow()" onmouseleave="kemacAppsubmenuHide()">
                                    <a href="">
                                    Kemedar Academy
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="kemacAppsubmenu" onmouseenter="kemacAppsubmenuShow()" onmouseleave="kemacAppsubmenuHide()" >
                                        <h5>
                                        GET THE MOBILE APP
                                        </h5>
                                        <div class="app-link">
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/google-play.svg" width="75px"  alt="">

                                        </a>
                                        <span>OR</span>
                                        <a href="">
                                            <img src="{{ static_asset('kemedar/images') }}/app-store.svg" width="65px" alt="">

                                        </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="kemmesengAppsubmenuShow()" onmouseleave="kemmesengAppsubmenuHide()">
                                    <a href="">
                                Kemedar Messenger
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                id="kemmesengAppsubmenu" onmouseenter="kemmesengAppsubmenuShow()" onmouseleave="kemmesengAppsubmenuHide()" >
                                    <h5>
                                    GET THE MOBILE APP
                                    </h5>
                                    <div class="app-link">
                                    <a href="">
                                        <img src="{{ static_asset('kemedar/images') }}/google-play.svg" width="75px"  alt="">

                                    </a>
                                    <span>OR</span>
                                    <a href="">
                                        <img src="{{ static_asset('kemedar/images') }}/app-store.svg" width="65px" alt="">

                                    </a>
                                    </div>
                                </div>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li onmouseenter="spsubmenuShow()" onmouseleave="spsubmenuHide()">
                        <a href="">
                            Social Pages
                        </a>
                        <div class="footer-menu inner-div"
                        id="spsubmenu" onmouseenter="spsubmenuShow()" onmouseleave="spsubmenuHide()" >
                            <ul class="outter-menu">
                                <li onmouseenter="kemspubmenuShow()" onmouseleave="kemspubmenuHide()">
                                    <a href="">
                                    Kemedar
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="kemspubmenu"onmouseenter="kemspubmenuShow()" onmouseleave="kemspubmenuHide()" >
                                        <h5>
                                        Social Pages
                                        </h5>
                                        <div class="app-link">
                                        <a href="" class="social-pages-icons">
                                            <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important;"></i>
                                        </a>
                                        <a href="" class="social-pages-icons">
                                            <i class="fa fa-linkedin" style="cursor: pointer;"></i>
                                        </a>
                                        <a href="" class="social-pages-icons">
                                            <i class="fa fa-twitter" style="cursor: pointer;"></i>
                                        </a>
                                        <a href="" class="social-pages-icons">
                                            <i class="fa fa-instagram" style="cursor: pointer;"></i>
                                        </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="kemetspubmenuShow()" onmouseleave="kemetspubmenuHide()">
                                    <a href="">
                                    Kemmeta
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="kemetspubmenu" onmouseenter="kemetspubmenuShow()" onmouseleave="kemetspubmenuHide()" >
                                        <h5>
                                        Social Pages
                                        </h5>
                                        <div class="app-link">
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-linkedin" style="cursor: pointer;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-twitter" style="cursor: pointer;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-instagram" style="cursor: pointer;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="kemetrospubmenuShow()" onmouseleave="kemetrospubmenuHide()">
                                    <a href="">
                                    Kemetro
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="kemetrospubmenu" onmouseenter="kemetrospubmenuShow()" onmouseleave="kemetrospubmenuHide()" >
                                        <h5>
                                        Social Pages
                                        </h5>
                                        <div class="app-link">
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-linkedin" style="cursor: pointer;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-twitter" style="cursor: pointer;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-instagram" style="cursor: pointer;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="newsspubmenuShow()" onmouseleave="newsspubmenuHide()">
                                    <a href="">
                                        Kemedar News
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="newsspubmenu" onmouseenter="newsspubmenuShow()" onmouseleave="newsspubmenuHide()" >
                                        <h5>
                                        Social Pages
                                        </h5>
                                        <div class="app-link">
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-linkedin" style="cursor: pointer;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-twitter" style="cursor: pointer;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-instagram" style="cursor: pointer;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="kemacspubmenuShow()" onmouseleave="kemacspubmenuHide()">
                                    <a href="">
                                    Kemedar Academy
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="kemacspubmenu" onmouseenter="kemacspubmenuShow()" onmouseleave="kemacspubmenuHide()" >
                                    <h5>
                                        Social Pages
                                    </h5>
                                    <div class="app-link">
                                        <a href="" class="social-pages-icons">
                                            <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important;"></i>
                                        </a>
                                        <a href="" class="social-pages-icons">
                                            <i class="fa fa-linkedin" style="cursor: pointer;"></i>
                                        </a>
                                        <a href="" class="social-pages-icons">
                                            <i class="fa fa-twitter" style="cursor: pointer;"></i>
                                        </a>
                                        <a href="" class="social-pages-icons">
                                            <i class="fa fa-instagram" style="cursor: pointer;"></i>
                                        </a>
                                        </div>
                                    </div>
                                </li>

                                <li onmouseenter="kemmesengspubmenuShow()" onmouseleave="kemmesengspubmenuHide()">
                                    <a href="">
                                Kemedar Messenger
                                    </a>
                                    <div class="footer-menu inner-div app-div"
                                    id="kemmesengspubmenu" onmouseenter="kemmesengspubmenuShow()" onmouseleave="kemmesengspubmenuHide()" >
                                        <h5>
                                        Social Pages
                                        </h5>
                                        <div class="app-link">
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-linkedin" style="cursor: pointer;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-twitter" style="cursor: pointer;"></i>
                                            </a>
                                            <a href="" class="social-pages-icons">
                                                <i class="fa fa-instagram" style="cursor: pointer;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                        </ul>
                        </div>
                    </li>

                    <li onmouseenter="fropsubmenuShow()" onmouseleave="fropsubmenuHide()">
                        <a href="">
                            Franchise Opportunities
                        </a>
                        <div class="footer-menu inner-div app-div"
                        id="fropsubmenu" onmouseenter="fropsubmenuShow()" onmouseleave="fropsubmenuHide()" >
                            <ul>
                            <li>
                                <a href="">
                                    Be Franchise Owner Area
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Be Franchise Owner country
                                </a>
                            </li>
                            </ul>

                        </div>
                    </li>

                    <li>
                        <a href="">
                            Term & Policies
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Privacy Policy
                        </a>
                    </li>
                '

                </ul>
            </div>
            <li>
                <a href="">
                    <i class="fa fa-search"></i>
                </a>
            </li>
            <li>
                <a href="" onmouseenter="feedbackTooltipToggle()" onmouseleave="feedbackTooltipHide()">
                    <i class="fa fa-envelope"></i>
                </a>
                <div class="smalltooltip" id="feedbackTooltip">
                    <div class="triangle"></div>

                    <p>Feedback</p>
                </div>
            </li>
            <li  onmouseenter="eyeSubMenuShow()" onmouseleave="eyeSubMenuHide()">
                <a href="" onmouseenter="helpTooltipToggle()" onmouseleave="helpTooltipHide()">
                    <i class="fa fa-eye"></i>
                </a>
                <div class="smalltooltip" id="helpTooltip">
                    <div class="triangle"></div>

                    <p>Help video</p>
                </div>
                <div class="footer-menu last-submenu" id="eyeSubMenu" onmouseenter="eyeSubMenuShow()" onmouseleave="eyeSubMenuHide()"  >
                    <ul class="outter-menu">
                        <li onmouseenter="regSubMenuShow()" onmouseleave="regSubMenuHide()">
                            <a href="">Register</a>
                            <div class="footer-menu inner-div" id="regSubMenu"
                            onmouseenter="regSubMenuShow()" onmouseleave="regSubMenuHide()" >
                                <ul class="outter-menu">
                                    <li>
                                        <a href="">Owner or Buyer</a>
                                    </li>
                                    <li>
                                        <a href="">Real Estate Agent or Developer</a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Handyman or specialist
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">Local Partners</a>
                                    </li>
                                    <li>
                                        <a href="">International Partners</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li onmouseenter="serSubMenuShow()" onmouseleave="serSubMenuHide()">
                            <a href="">Search</a>
                            <div class="footer-menu inner-div" id="serSubMenu"
                            onmouseenter="serSubMenuShow()" onmouseleave="serSubMenuHide()">
                                <ul class="outter-menu">
                                    <li>
                                        <a href="">Properties</a>
                                    </li>
                                    <li>
                                        <a href="">Tasks</a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Handymen
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li onmouseenter="addSubMenuShow()" onmouseleave="addSubMenuHide()">
                            <a href="">Add</a>
                            <div class="footer-menu inner-div" id="addSubMenu"
                            onmouseenter="addSubMenuShow()" onmouseleave="addSubMenuHide()">
                                <ul class="outter-menu">
                                    <li>
                                        <a href="">Property</a>
                                    </li>
                                    <li>
                                        <a href="">Requests</a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Projects
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">Tasks</a>
                                    </li>


                                </ul>
                            </div>
                        </li>
                        <li onmouseenter="doSubMenuShow()" onmouseleave="doSubMenuHide()">
                            <a href="">Do</a>
                            <div class="footer-menu inner-div" id="doSubMenu"
                            onmouseenter="doSubMenuShow()" onmouseleave="doSubMenuHide()">
                                <ul class="outter-menu">
                                    <li>
                                        <a href="">Advertise with us</a>
                                    </li>
                                    <li>
                                        <a href="">Be our  affiliate</a>
                                    </li>
                                    <li>
                                        <a href="">
                                        Upgrade your membership
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">Invest with us</a>
                                    </li>


                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        <ul class="first-menu-sidebar">
            <li>
                <a href="">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-linkedin"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14px"
                        height="14px">
                        <path
                            d="M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z">
                        </path>
                    </svg>
                </a>
            </li>


        </ul>
    </div>
    <!-- sidebar ends -->
<!-- kemedar top header fixed end -->

<!-- kemedar top header js start -->
<script src="https://kit.fontawesome.com/fc057e91f8.js" crossorigin="anonymous"></script>
<script src="{{ static_asset('kemedar/js/app.js') }}"></script>
<!-- kemedar top header js end -->
