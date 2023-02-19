 <!-- footer starts -->
 <section class="footer-container">
    <div class="footer-inner-container">
        <ul class="footer-nav" style="color: #ededed !important">
            <li>
            <a href="" style="color: #ededed !important">
                My Cpanel
            </a>
            </li>
            |
            <li onmouseenter="finddropdownshow()" onmouseleave="finddropdownhide()">
            <a href="" style="color: #ededed !important">
                Find
            </a>
            <div class=" benefit-div find-div" id="finddropdown"
            style="background: url('{{ static_asset('/kemedar') }}/images/FindImage.png') no-repeat 50% 88%/14em , #ededed;"
            onmouseenter="finddropdownshow()" onmouseleave="finddropdownhide()" >
                    <div>
                        <span class="active-span">Find</span>
                    </div>
                    <ul class="benefit-list" style="margin-top: 10px !important; margin-left: -20px !important;">
                        <li onmouseenter="properSubmenushow()" onmouseleave="properSubmenuhide()">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-01.png" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Properties</span>
                            </a>
                            <div class="inner-submenu" id="properSubmenu" onmouseenter="properSubmenushow()" onmouseleave="properSubmenuhide()">
                                <div>
                                    <span class="active-span">Properties</span>
                                </div>
                                <ul>

                                    <li class="brn">
                                            <i >
                                            <img src="{{ static_asset('/kemedar') }}/images/property/Icon-01.png" class="img-fluid" alt="">
                                            </i>
                                        <a href="">
                                            <span>For Sale</span>
                                        </a>
                                    </li>
                                    <li class="brn">
                                        <i >
                                        <img src="{{ static_asset('/kemedar') }}/images/property/Icon-02.png" class="img-fluid" alt="">
                                        </i>
                                    <a href="">
                                        <span>For Sale or Rent</span>
                                    </a>
                                </li>
                                <li class="brn">
                                    <i >
                                    <img src="{{ static_asset('/kemedar') }}/images/property/Icon-04.png" class="img-fluid" alt="">
                                    </i>
                                <a href="">
                                    <span>For Rent</span>
                                </a>
                            </li>
                            <li class="brn">
                                <i >
                                <img src="{{ static_asset('/kemedar') }}/images/property/Icon-05.png" class="img-fluid" alt="">
                                </i>
                            <a href="">
                                <span>For daily booking</span>
                            </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Kemedar Reit in Auction System</span>
                        </a>
                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="" style="color:#000 !important;"
                        onmouseenter="taskerSubmenushow()" onmouseleave="taskerSubmenuhide()">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-02.png" class="img-fluid" alt="">
                            </i>

                            <a href="">
                                <span>Handymen & technicians</span>
                            </a>
                            <div class="inner-submenu taskerSubmenu" id="taskerSubmenu"
                            onmouseenter="taskerSubmenushow()" onmouseleave="taskerSubmenuhide()">

                                <ul>

                                    <li class="brn">
                                            <i >

                                            </i>
                                        <a href="">
                                            <span>Tasker Categories</span>
                                        </a>
                                    </li>




                                </ul>
                            </div>
                        </li>
                        <li class="brn">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-03.png" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Prjects & Compunds</span>
                            </a>
                        </li>
                        <br>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-04.png" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Agents</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-05.png" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Developers</span>
                            </a>
                        </li>
                        <li class="brn">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-12.png" class="img-fluid" alt="">
                            </i>
                            <a href="">
                                <span>Finishing Companies</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-10.png" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/carpenter.html">
                                <span>Franchise Owner</span>
                            </a>
                        </li>
                        <li  style="color:#000 !important;" onmouseenter="productSubmenushow()" onmouseleave="productSubmenuhide()">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-09.png" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/lawyer.html">
                                <span>Products</span>
                            </a>
                            <div class="product-submenu" id="productSubmenu" onmouseenter="productSubmenushow()" onmouseleave="productSubmenuhide()">
                                <div class="left-div-submenu">
                                    <div>
                                        <span class="active-span">Products</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-01.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Construction</span>
                                            </a>
                                        </li>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-02.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Manosry Material</span>
                                            </a>
                                        </li>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-03.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Architectural</span>
                                            </a>
                                        </li>

                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-04.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Electrical</span>
                                            </a>
                                        </li>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-05.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Plumbing</span>
                                            </a>
                                        </li>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-06.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Mechanical</span>
                                            </a>
                                        </li>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-07.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Appliances</span>
                                            </a>
                                        </li>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-08.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Furniture</span>
                                            </a>
                                        </li>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-09.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Decorative</span>
                                            </a>
                                        </li>
                                        <li>
                                            <i>
                                                <img src="{{ static_asset('/kemedar') }}/images/product/Icon-10.png" alt="">
                                            </i>
                                            <a href="">
                                                <span>Landscape &amp; Garden</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="left-right-submenu">
                                    <img src="{{ static_asset('/kemedar') }}/images/products.png" width="100%" height="auto" alt="">
                                </div>
                            </div>
                        </li>
                        <li class="brn">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-08.png" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/decorist.html">
                                <span>Product Sellers</span>
                            </a>
                        </li>
                        <li class="">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-07.png" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/painter.html">
                                <span>Job or Career</span>
                            </a>
                        </li>

                        <li class="">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-06.png" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/carpenter.html">
                                <span>Instructor</span>
                            </a>
                        </li>
                        <li class="brn" style="color:#000 !important;">
                            <i>
                                <img src="{{ static_asset('/kemedar') }}/images/find/Icon-11.png" class="img-fluid" style="width:20px" alt="">
                            </i>
                            <a href="hire-technician/lawyer.html">
                                <span>Training Course</span>
                            </a>
                        </li>

                    </ul>

            </div>
            </li>
            |
            <li onmouseenter="addDivshow()" onmouseleave="addDivhide()">
            <a href="" style="color: #ededed !important">
                Add
            </a>
            <div class=" benefit-div find-div " id="addDiv" onmouseenter="addDivshow()" onmouseleave="addDivhide()"
            style="background: url('{{ static_asset('/kemedar') }}/images/add.png') no-repeat 50% 88%/23em , #ededed;" >
                <div>
                    <span class="active-span">Add</span>
                </div>
                <ul class="benefit-list" style="margin-top: 10px !important;
                margin-left: -20px !important;">
                    <li>
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Property</span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-02.png" class="img-fluid" alt="">
                        </i>

                        <a href="">
                            <span>Buy Request</span>
                        </a>
                    </li>
                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-03.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Project</span>
                        </a>
                    </li>
                    <br>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-06.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Investment opportunity</span>
                        </a>
                    </li>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-07.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Store</span>
                        </a>
                    </li>
                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-08.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Product</span>
                        </a>
                    </li>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-09.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/carpenter.html">
                            <span>Post</span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-04.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/lawyer.html">
                            <span>Page</span>
                        </a>
                    </li>
                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-05.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/decorist.html">
                            <span>Group</span>
                        </a>
                    </li>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-11.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/painter.html">
                            <span>Event</span>
                        </a>
                    </li>

                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-10.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/carpenter.html">
                            <span>Used product</span>
                        </a>
                    </li>
                    <li class="brn" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-12.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/lawyer.html">
                            <span>Video news</span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-14.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/lawyer.html">
                            <span>Article news</span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/add/Icon-13.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/lawyer.html">
                            <span>Course</span>
                        </a>
                    </li>




                </ul>

            </div>
            </li>
            |
            <li onmouseenter="investDivshow()" onmouseleave="investDivhide()">
            <a href="" style="color: #ededed !important">
                Invest
            </a>
            <div class=" benefit-div find-div " id="investDiv" onmouseenter="investDivshow()" onmouseleave="investDivhide()"
            style="background: url('{{ static_asset('/kemedar') }}/images/invest.png') no-repeat 50% 88%/23em , #ededed;" >
                <div>
                    <span class="active-span">Invest</span>
                </div>
                <ul class="benefit-list" style="margin-top: 10px !important;
                margin-left: -20px !important;">
                    <li>
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Invest my real estate</span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-02.png" class="img-fluid" alt="">
                        </i>

                        <a href="">
                            <span>Invest my real estate</span>
                        </a>
                    </li>

                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-03.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Invest in Kemedar Reits</span>
                        </a>
                    </li>
                    <br>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-04.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Find investment opportunity </span>
                        </a>
                    </li>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-05.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Buy stock in real company  </span>
                        </a>
                    </li>
                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-06.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Crowd investment </span>
                        </a>
                    </li>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-07.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/carpenter.html">
                            <span>Venture investment </span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-08.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/lawyer.html">
                            <span>Invest in startup </span>
                        </a>
                    </li>
                    <li class="brn" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/invest/Icon-09.png" class="img-fluid" style="width:20px" alt="">
                        </i>
                        <a href="hire-technician/lawyer.html">
                            <span>Angel investment</span>
                        </a>
                    </li>








                </ul>

            </div>
            </li>
            |
            <li onmouseenter="connectDivshow()" onmouseleave="connectDivhide()">
            <a href="" style="color: #ededed !important">
            Connect
            </a>
            <div class=" benefit-div find-div " id="connectDiv" onmouseenter="connectDivshow()" onmouseleave="connectDivhide()"
            style="background: url('{{ static_asset('/kemedar') }}/images/CONNCECT.png') no-repeat 50% 88%/23em , #ededed;" >
                <div>
                    <span class="active-span">Connect</span>
                </div>
                <ul class="benefit-list" style="margin-top: 10px !important;
                margin-left: -20px !important;">
                    <li>
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/connect/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>News Feed</span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/connect/Icon-02.png" class="img-fluid" alt="">
                        </i>

                        <a href="">
                            <span>Find friend</span>
                        </a>
                    </li>

                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/connect/Icon-03.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Groups</span>
                        </a>
                    </li>
                    <br>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/connect/Icon-04.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Pages </span>
                        </a>
                    </li>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/connect/Icon-05.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Forums </span>
                        </a>
                    </li>


                </ul>

            </div>
            </li>
            |
            <li onmouseenter="knowDivshow()" onmouseleave="knowDivhide()">
            <a href="" style="color: #ededed !important">
            Know
            </a>
            <div class=" benefit-div find-div " id="knowDiv" onmouseenter="knowDivshow()" onmouseleave="knowDivhide()"
            style="background: url('{{ static_asset('/kemedar') }}/images/know.png') no-repeat 50% 88%/23em , #ededed;" >
                <div>
                    <span class="active-span">Know</span>
                </div>
                <ul class="benefit-list" style="margin-top: 10px !important;
                margin-left: -20px !important;">
                    <li>
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/know/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Recent news</span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/know/Icon-02.png" class="img-fluid" alt="">
                        </i>

                        <a href="">
                            <span>Trending news</span>
                        </a>
                    </li>

                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/know/Icon-03.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Reports</span>
                        </a>
                    </li>
                    <br>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/know/Icon-04.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Real estate market news</span>
                        </a>
                    </li>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/know/Icon-05.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Real estate investment</span>
                        </a>
                    </li>
                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/know/Icon-06.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Governmental & legal news</span>
                        </a>
                    </li>
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/know/Icon-07.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Auction & Tenders</span>
                        </a>
                    </li>


                </ul>

            </div>
            </li>
            |
            <li onmouseenter="learnDivshow()" onmouseleave="learnDivhide()">
            <a href="" style="color: #ededed !important">
            Learn
            </a>
            <div class=" benefit-div find-div " id="learnDiv" onmouseenter="learnDivshow()" onmouseleave="learnDivhide()"
            style="background: url('{{ static_asset('/kemedar') }}/images/learn.png') no-repeat 50% 88%/23em , #ededed;" >
                <div>
                    <span class="active-span">Learn</span>
                </div>
                <ul class="benefit-list" style="margin-top: 10px !important;
                margin-left: -20px !important;">
                    <li onmouseenter="consDivshow()" onmouseleave="consDivhide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/find/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Construction</span>
                        </a>
                        <div class="inner-submenu" id="consDiv" onmouseenter="consDivshow()" onmouseleave="consDivhide()">
                            <div>
                                <span class="active-span">Construction</span>
                            </div>
                            <ul>

                                <li class="brn">
                                        <i >
                                        <img src="{{ static_asset('/kemedar') }}/images/property/Icon-01.png" class="img-fluid" alt="">
                                        </i>
                                    <a href="">
                                        <span>Construction Worker</span>
                                    </a>
                                </li>
                                <li class="brn">
                                    <i >
                                    <img src="{{ static_asset('/kemedar') }}/images/property/Icon-02.png" class="img-fluid" alt="">
                                    </i>
                                <a href="">
                                    <span>Brick Mason</span>
                                </a>
                            </li>
                            <li class="brn">
                                <i >
                                <img src="{{ static_asset('/kemedar') }}/images/property/Icon-04.png" class="img-fluid" alt="">
                                </i>
                            <a href="">
                                <span>Construction</span>
                            </a>
                        </li>
                        <li class="brn">
                            <i >
                            <img src="{{ static_asset('/kemedar') }}/images/property/Icon-05.png" class="img-fluid" alt="">
                            </i>
                        <a href="">
                            <span>Surveyor</span>
                        </a>
                    </li>
                    <li class="brn">
                        <i >
                        <img src="{{ static_asset('/kemedar') }}/images/property/Icon-05.png" class="img-fluid" alt="">
                        </i>
                    <a href="">
                        <span>Conceret finisher</span>
                    </a>
                </li>

                    <li class="brn">
                        <i >
                            <img src="{{ static_asset('/kemedar') }}/images/property/Icon-05.png" class="img-fluid" alt="">
                        </i>
                    <a href="">
                        <span>Ironworker</span>
                    </a>
                    </li>
                    <li class="brn">
                        <i >
                            <img src="{{ static_asset('/kemedar') }}/images/property/Icon-05.png" class="img-fluid" alt="">
                        </i>
                    <a href="">
                        <span>Crane operater</span>
                    </a>
                    </li>
                            </ul>
                        </div>
                    </li>
                    <li class="" onmouseenter="HomeDSubmenushow()" onmouseleave="HomeDSubmenuhide()" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/find/Icon-02.png" class="img-fluid" alt="">
                        </i>

                        <a href="">
                            <span style="font-size: 11px   !important;">Home Development & Finishing</span>
                        </a>
                        <div class="inner-submenu taskerSubmenu" id="HomeDSubmenu"
                        onmouseenter="HomeDSubmenushow()" onmouseleave="HomeDSubmenuhide()">

                            <ul>
                        <li class="brn">
                                    <i >

                                    </i>
                                    <a href="">
                                        <span>Home Design Archetict</span>
                                    </a>
                        </li>
                        <li class="brn">
                                <i >

                                </i>
                            <a href="">
                                <span>Painter</span>
                            </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Plumber</span>
                        </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Electrician</span>
                        </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Flooring</span>
                        </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Tile setter</span>
                        </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Roofer</span>
                        </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Carpenter</span>
                        </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Glazier</span>
                        </a>
                        </li>



                            </ul>
                        </div>
                    </li>

                    <li class="brn" onmouseenter="rebSubmenushow()" onmouseleave="rebSubmenuhide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/find/Icon-02.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Real Estate Business</span>
                        </a>
                        <div class="inner-submenu taskerSubmenu" id="rebSubmenu" onmouseenter="rebSubmenushow()" onmouseleave="rebSubmenuhide()">

                            <ul>
                        <li class="brn">
                                    <i >

                                    </i>
                                    <a href="">
                                        <span>
                                        Managment
                                        </span>
                                    </a>
                        </li>
                        <li class="brn">
                                <i >

                                </i>
                            <a href="">
                                <span>
                                    Communications
                                </span>
                            </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Business Strategy</span>
                        </a>
                        </li>
                        <li class="brn">
                            <i >

                            </i>
                        <a href="">
                            <span>Real estate Marketing</span>
                        </a>
                        </li>







                            </ul>
                        </div>
                    </li>
                    <br>
                    <li onmouseenter="hdhDivshow()" onmouseleave="hdhDivhide()" >
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/find/Icon-09.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Home decoration & homestyle</span>
                        </a>
                        <div class="inner-submenu" id="hdhDiv" onmouseenter="hdhDivshow()" onmouseleave="hdhDivhide()">
                            <div>
                                <span class="active-span">Home decoration & homestyle</span>
                            </div>
                            <ul>

                                <li class="">
                                        <i >
                                        <img src="{{ static_asset('/kemedar') }}/images/product/Icon-01.png" class="img-fluid" alt="">
                                        </i>
                                    <a href="">
                                        <span>Home decoration</span>
                                    </a>
                                </li>
                                <li class="">
                                    <i >
                                    <img src="{{ static_asset('/kemedar') }}/images/product/Icon-02.png" class="img-fluid" alt="">
                                    </i>
                                <a href="">
                                    <span>Do it Yourself</span>
                                </a>
                            </li>




                            </ul>
                        </div>
                    </li>




                </ul>

            </div>
            </li>
            |
            <li onmouseenter="paidservicesDivshow()" onmouseleave="paidservicesDivhide()">
            <a href="" style="color: #ededed !important">
            Paid Services
            </a>
            <div class=" benefit-div find-div " id="paidservicesDiv"
            onmouseenter="paidservicesDivshow()" onmouseleave="paidservicesDivhide()" style="background: url('{{ static_asset('/kemedar') }}/images/paid.png') no-repeat 50% 155%/23em , #ededed;" >
                <div>
                    <span class="active-span">Paid Services</span>
                </div>
                <ul class="benefit-list" style="margin-top: 10px !important;
                margin-left: -20px !important;">
                    <li>
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/paid/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Subscriptions</span>
                        </a>
                    </li>
                    <li class="" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/paid/Icon-02.png" class="img-fluid" alt="">
                        </i>

                        <a href="">
                            <span >Advertising services</span>
                        </a>
                    </li>

                    <li class="brn">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/paid/Icon-03.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Promotional services</span>
                        </a>
                    </li>
                    <br>
                    <li class="" >
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/paid/Icon-04.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Legal services</span>
                        </a>
                    </li>
                    <li class="" >
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/paid/Icon-05.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Professional services</span>
                        </a>
                    </li>
                    <li class="brn" >
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/paid/Icon-06.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Other services</span>
                        </a>
                    </li>




                </ul>

            </div>
            </li>
            |
            <li onmouseenter="userbenefitsDivshow()" onmouseleave="userbenefitsDivhide()">
            <a href="" style="color: #ededed !important">
            User Benefits
            </a>
            <div class="benefit-div find-div " id="userbenefitsDiv" onmouseenter="userbenefitsDivshow()" onmouseleave="userbenefitsDivhide()" >
            <div>
                <span class="active-span">User Benefits</span>
            </div>
            <ul class="benefit-list" style="margin-top:10px !important; margin-left: -20px;">
                <li>
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-01.png" class="img-fluid" alt="">
                    </i>
                    <a href="">
                        <span>Property Seller</span>
                    </a>
                </li>
                <li class="" style="color:#000 !important;">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-01.png" class="img-fluid" alt="">
                    </i>

                    <a href="">
                        <span>Property Buyer</span>
                    </a>
                </li>
                <li class="brn">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-02.png" class="img-fluid" alt="">
                    </i>
                    <a href="">
                        <span>Product Seller</span>
                    </a>
                </li>
                <br>
                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-03.png" class="img-fluid" alt="">
                    </i>
                    <a href="">
                        <span>Product Buyer</span>
                    </a>
                </li>
                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-04.png" class="img-fluid" alt="">
                    </i>
                    <a href="">
                        <span>Store Collaborator</span>
                    </a>
                </li>
                <li class="brn">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-05.png" class="img-fluid" alt="">
                    </i>
                    <a href="">
                        <span>Product Shipper</span>
                    </a>
                </li>
                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-06.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/carpenter.html">
                        <span>Real estate Agent</span>
                    </a>
                </li>
                <li class="" style="color:#000 !important;">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-07.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/lawyer.html">
                        <span>Real estate Developer</span>
                    </a>
                </li>
                <li class="brn">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-08.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/decorist.html">
                        <span>Handyman or Technician</span>
                    </a>
                </li>
                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-18.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/painter.html">
                        <span>Finishing Company</span>
                    </a>
                </li>

                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-11.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/carpenter.html">
                        <span>Investor</span>
                    </a>
                </li>
                <li class="brn" style="color:#000 !important;">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-12.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/lawyer.html">
                        <span>Affiliate Marketer</span>
                    </a>
                </li>
                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-13.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/decorist.html">
                        <span>Freelancer</span>
                    </a>
                </li>
                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-14.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/painter.html">
                        <span>Job Seeker</span>
                    </a>
                </li>
                <li class="brn">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-15.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/floor_worker.html">
                        <span>Kemmeta community member</span>
                    </a>
                </li>
                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-16.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="">
                        <span>Trainer or Instructor</span>
                    </a>
                </li>
                <li class="">
                    <i>
                        <img src="{{ static_asset('/kemedar') }}/images/register/Icon-17.png" class="img-fluid" style="width:20px" alt="">
                    </i>
                    <a href="hire-technician/carpenter.html">
                        <span>Academy Student</span>
                    </a>
                </li>
            </ul>

            </div>
            </li>

            <li onmouseenter="appdivshow()" onmouseleave="appdivhide()">
            <a href="" style="color: #ededed !important">
            Mobile Apps
            </a>
            <div class="benefit-div find-div appdiv " id="appdiv"
            onmouseenter="appdivshow()" onmouseleave="appdivhide()">
                <div>
                    <span class="active-span">Mobile Apps</span>
                </div>
                <ul class="benefit-list" style="margin-top:20px !important; margin-left: -25px;">
                    <li class="brn" onmouseenter="kemeappDivshow()" onmouseleave="kemeappDivhide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemedar</span>
                        </a>
                        <div class="inner-submenu" id="kemeappDiv" onmouseenter="kemeappDivshow()" onmouseleave="kemeappDivhide()">
                            <div>
                                <span class="active-span">Kemedar</span>
                            </div>

                            <div style="margin-top: -10px;">
                                    <div class="get-app">
                                        <h6>
                                            <b style="color:#c33">GET THE MOBILE APP</b>
                                        </h6>
                                        <a href="" style="display: inline !important; padding: 0px !important;">
                                            <img src="{{ static_asset('/kemedar') }}/images/google-play.svg" width="75px" alt="">

                                        </a>
                                        <span style="display: inline !important; padding: 0px !important;">or</span>
                                        <a href="" style="display: inline !important; padding: 0px !important;  margin-left: 8px;">
                                            <img src="{{ static_asset('/kemedar') }}/images/app-store.svg" width="63px" alt="">

                                        </a>

                                    </div>
                                </div>
                        </div>
                    </li>
                    <li class="brn" onmouseenter="kemetoappDivshow()" onmouseleave="kemetoappDivhide()" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-02.png" class="img-fluid" alt="">
                        </i>

                        <a href="">
                            <span>Kemmeto</span>
                        </a>
                        <div class="inner-submenu" id="kemetoappDiv" onmouseenter="kemetoappDivshow()" onmouseleave="kemetoappDivhide()">
                            <div>
                                <span class="active-span">Kemmeto</span>
                            </div>

                            <div style="margin-top: -10px;">
                                    <div class="get-app">
                                        <h6>
                                            <b style="color:#c33">GET THE MOBILE APP</b>
                                        </h6>
                                        <a href="" style="display: inline !important; padding: 0px !important;">
                                            <img src="{{ static_asset('/kemedar') }}/images/google-play.svg" width="75px" alt="">

                                        </a>
                                        <span style="display: inline !important; padding: 0px !important;">or</span>
                                        <a href="" style="display: inline !important; padding: 0px !important;  margin-left: 8px;">
                                            <img src="{{ static_asset('/kemedar') }}/images/app-store.svg" width="63px" alt="">

                                        </a>

                                    </div>
                                </div>
                        </div>
                    </li>
                    <li class="brn" onmouseenter="kemetroappDivshow()" onmouseleave="kemetroappDivhide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-03.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemmetro</span>
                        </a>
                        <div class="inner-submenu" id="kemetroappDiv" onmouseenter="kemetroappDivshow()" onmouseleave="kemetroappDivhide()">
                            <div>
                                <span class="active-span">Kemmetro</span>
                            </div>

                            <div style="margin-top: -10px;">
                                    <div class="get-app">
                                        <h6>
                                            <b style="color:#c33">GET THE MOBILE APP</b>
                                        </h6>
                                        <a href="" style="display: inline !important; padding: 0px !important;">
                                            <img src="{{ static_asset('/kemedar') }}/images/google-play.svg" width="75px" alt="">

                                        </a>
                                        <span style="display: inline !important; padding: 0px !important;">or</span>
                                        <a href="" style="display: inline !important; padding: 0px !important;  margin-left: 8px;">
                                            <img src="{{ static_asset('/kemedar') }}/images/app-store.svg" width="63px" alt="">

                                        </a>

                                    </div>
                                </div>
                        </div>
                    </li>

                    <li class="brn" onmouseenter="kemenewsappDivshow()" onmouseleave="kemenewsappDivhide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-04.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemedar News</span>
                        </a>
                        <div class="inner-submenu" id="kemenewsappDiv" onmouseenter="kemenewsappDivshow()" onmouseleave="kemenewsappDivhide()">
                            <div>
                                <span class="active-span">Kemedar News</span>
                            </div>

                            <div style="margin-top: -10px;">
                                    <div class="get-app">
                                        <h6>
                                            <b style="color:#c33">GET THE MOBILE APP</b>
                                        </h6>
                                        <a href="" style="display: inline !important; padding: 0px !important;">
                                            <img src="{{ static_asset('/kemedar') }}/images/google-play.svg" width="75px" alt="">

                                        </a>
                                        <span style="display: inline !important; padding: 0px !important;">or</span>
                                        <a href="" style="display: inline !important; padding: 0px !important;  margin-left: 8px;">
                                            <img src="{{ static_asset('/kemedar') }}/images/app-store.svg" width="63px" alt="">

                                        </a>

                                    </div>
                                </div>
                        </div>
                    </li>
                    <li class="brn" onmouseenter="kemeacaappDivshow()" onmouseleave="kemeacaappDivhide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-05.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemedar Academy</span>
                        </a>
                        <div class="inner-submenu" id="kemeacaappDiv" onmouseenter="kemeacaappDivshow()" onmouseleave="kemeacaappDivhide()">
                            <div>
                                <span class="active-span">Kemedar Academy</span>
                            </div>

                            <div style="margin-top: -10px;">
                                    <div class="get-app">
                                        <h6>
                                            <b style="color:#c33">GET THE MOBILE APP</b>
                                        </h6>
                                        <a href="" style="display: inline !important; padding: 0px !important;">
                                            <img src="{{ static_asset('/kemedar') }}/images/google-play.svg" width="75px" alt="">

                                        </a>
                                        <span style="display: inline !important; padding: 0px !important;">or</span>
                                        <a href="" style="display: inline !important; padding: 0px !important;  margin-left: 8px;">
                                            <img src="{{ static_asset('/kemedar') }}/images/app-store.svg" width="63px" alt="">

                                        </a>

                                    </div>
                                </div>
                        </div>
                    </li>
                    <li class="brn" onmouseenter="messengerappDivshow()" onmouseleave="messengerappDivhide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemedar Messenger</span>
                        </a>
                        <div class="inner-submenu" id="messengerappDiv" onmouseenter="messengerappDivshow()" onmouseleave="messengerappDivhide()">
                            <div>
                                <span class="active-span">Kemedar Messenger</span>
                            </div>

                            <div style="margin-top: -10px;">
                                    <div class="get-app">
                                        <h6>
                                            <b style="color:#c33">GET THE MOBILE APP</b>
                                        </h6>
                                        <a href="" style="display: inline !important; padding: 0px !important;">
                                            <img src="{{ static_asset('/kemedar') }}/images/google-play.svg" width="75px" alt="">

                                        </a>
                                        <span style="display: inline !important; padding: 0px !important;">or</span>
                                        <a href="" style="display: inline !important; padding: 0px !important;  margin-left: 8px;">
                                            <img src="{{ static_asset('/kemedar') }}/images/app-store.svg" width="63px" alt="">

                                        </a>

                                    </div>
                                </div>
                        </div>
                    </li>

                </ul>

            </div>
            </li>
            |
            <li onmouseenter="socialdivshow()" onmouseleave="socialdivhide()" >
            <a href="" style="color: #ededed !important">
                Social Pages
            </a>
            <div class="benefit-div find-div appdiv " onmouseenter="socialdivshow()" onmouseleave="socialdivhide()" id="socialdiv" >
                <div>
                    <span class="active-span">Social Pages</span>
                </div>
                <ul class="benefit-list" style="margin-top:20px !important; margin-left: -25px;">
                    <li class="brn" onmouseenter="kemesocialAppshow()" onmouseleave="kemesocialApphide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemedar</span>
                        </a>
                        <div class="footer-menu inner-div app-div" id="kemesocialApp"
                        onmouseenter="kemesocialAppshow()" onmouseleave="kemesocialApphide()"  >
                            <div>
                                <span class="active-span" style="margin-left: 20px; margin-bottom: 20px !important;">Kemedar</span>
                            </div>
                            <h5>
                            Social Pages
                            </h5>
                            <div class="app-link new-social">
                                <a href="" class="social-pages-icons ">
                                    <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-linkedin" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-twitter" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-instagram" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                </div>
                        </div>
                    </li>
                    <li class="brn" onmouseenter="kemmetosocialAppshow()" onmouseleave="kemmetosocialApphide()"
                    style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-02.png" class="img-fluid" alt="">
                        </i>

                        <a href="">
                            <span>Kemmeto</span>
                        </a>
                        <div class="footer-menu inner-div app-div" id="kemmetosocialApp"
                        onmouseenter="kemmetosocialAppshow()" onmouseleave="kemmetosocialApphide()"  >
                            <div>
                                <span class="active-span" style="margin-left: 20px; margin-bottom: 20px !important;">Kemmeto</span>
                            </div>
                            <h5>
                            Social Pages
                            </h5>
                            <div class="app-link new-social">
                                <a href="" class="social-pages-icons ">
                                    <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-linkedin" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-twitter" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-instagram" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                </div>
                        </div>
                    </li>
                    <li class="brn" onmouseenter="kemmetrosocialAppshow()" onmouseleave="kemmetrosocialApphide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-03.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemmetro</span>
                        </a>
                        <div class="footer-menu inner-div app-div" id="kemmetrosocialApp" onmouseenter="kemmetrosocialAppshow()" onmouseleave="kemmetrosocialApphide()"  >
                            <div>
                                <span class="active-span" style="margin-left: 20px; margin-bottom: 20px !important;">Kemmetro</span>
                            </div>
                            <h5>
                            Social Pages
                            </h5>
                            <div class="app-link new-social">
                                <a href="" class="social-pages-icons ">
                                    <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-linkedin" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-twitter" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-instagram" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                </div>
                        </div>
                    </li>

                    <li class="brn" onmouseenter="kemmenewssocialAppshow()" onmouseleave="kemmenewssocialApphide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-04.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemedar News</span>
                        </a>
                        <div class="footer-menu inner-div app-div" id="kemmenewssocialApp" onmouseenter="kemmenewssocialAppshow()" onmouseleave="kemmenewssocialApphide()" >
                            <div>
                                <span class="active-span" style="margin-left: 20px; margin-bottom: 20px !important;">Kemedar News</span>
                            </div>
                            <h5>
                            Social Pages
                            </h5>
                            <div class="app-link new-social">
                                <a href="" class="social-pages-icons ">
                                    <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-linkedin" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-twitter" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-instagram" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                </div>
                        </div>
                    </li>
                    <li class="brn" onmouseenter="kemmeacasocialAppshow()" onmouseleave="kemmeacasocialApphide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-05.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemedar Academy</span>
                        </a>
                        <div class="footer-menu inner-div app-div" id="kemmeacasocialApp"  onmouseenter="kemmeacasocialAppshow()" onmouseleave="kemmeacasocialApphide()" >
                            <div>
                                <span class="active-span" style="margin-left: 20px; margin-bottom: 20px !important;">Kemedar Academy</span>
                            </div>
                            <h5>
                            Social Pages
                            </h5>
                            <div class="app-link new-social">
                                <a href="" class="social-pages-icons ">
                                    <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-linkedin" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-twitter" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-instagram" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                </div>
                        </div>
                    </li>
                    <li class="brn" onmouseenter="messengersocialAppshow()" onmouseleave="messengersocialApphide()">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/mobile/Icon-01.png" class="img-fluid" alt="">
                        </i>
                        <a href="">
                            <span>Kemedar Messenger</span>
                        </a>
                        <div class="footer-menu inner-div app-div" id="messengersocialApp" onmouseenter="messengersocialAppshow()" onmouseleave="messengersocialApphide()"  >
                            <div>
                                <span class="active-span" style="margin-left: 20px; margin-bottom: 20px !important;">Kemedar Messenger</span>
                            </div>
                            <h5>
                            Social Pages
                            </h5>
                            <div class="app-link new-social">
                                <a href="" class="social-pages-icons ">
                                    <i class="fa fa-facebook pointer" style="padding: 6px; cursor: pointer !important; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-linkedin" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-twitter" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                <a href="" class="social-pages-icons">
                                    <i class="fa fa-instagram" style="cursor: pointer; " aria-hidden="true"></i>
                                </a>
                                </div>
                        </div>
                    </li>

                </ul>

            </div>
            </li>
            |
            <li onmouseenter="franchisedivshow()" onmouseleave="franchisedivhide()">
            <a href="" style="color: #ededed !important">
            Franchise Opportunities
            </a>
            <div class="benefit-div find-div frnchdiv " id="franchisediv" onmouseenter="franchisedivshow()" onmouseleave="franchisedivhide()" >
                <div>
                    <span class="active-span">Franchise Opportunities</span>
                </div>
                <ul class="benefit-list" style="margin-top:20px !important; margin-left: -25px;">
                    <li class="">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/area.jpeg" class="img-fluid" width="20px" height="20px" alt="">
                        </i>
                        <a href="">
                            <span>Be Franchise owner area</span>
                        </a>
                    </li>
                    <li class="brn" style="color:#000 !important;">
                        <i>
                            <img src="{{ static_asset('/kemedar') }}/images/countrylocation.jpeg" class="img-fluid" alt="" width="20px" height="20px">
                        </i>

                        <a href="">
                            <span>Be Franchise owner country</span>
                        </a>
                    </li>



                </ul>

            </div>
            </li>
            |
            <li>
            <a href="" style="color: #ededed !important">
            Term & Policies
            </a>
            </li>
            |
            <li>
            <a href="" style="color: #ededed !important">
            Privacy Policy
            </a>
            </li>
        </ul>
        <p class="copyright" >KEMEDAR® 2014, All rights reserved to KEMEDAR CORPORATION, Miami, Florida, USA. Reg, No. 5754985</p>
    </div>
</section>
<!-- footer ends -->
