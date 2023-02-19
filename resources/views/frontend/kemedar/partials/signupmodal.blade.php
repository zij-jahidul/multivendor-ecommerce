<!-- sign-up page starts -->
<div class="signup-model" id="signupmodelDiv">
    <div class="signup-model-from-div">
        <div class="model-upper">
            <h2>Signup Here</h2>
            <i class="fa fa-close" onclick="signupmodelDivhide()"></i>
        </div>
        <div class="middle-model">
            <form action="">
                <h4>Create your account</h4>
                <p>Enter your personal details to create account</p>
                <div>
                    <label for="" class="form-lable">Your Name</label>
                    <input type="text" class="login-form name-input" placeholder="First Name">
                    <input type="text" class="login-form name-input" placeholder="Last Name">
                </div>
                <div class="form-g">
                    <label for="" class="form-lable">Phone Number</label>
                    <div class="checkbox-div ">
                        <input id="checkbox2" class="" type="checkbox" onclick="toggleEmailPhone()">
                        <label class=" " for="checkbox2">
                            I want to use my Email
                        </label>
                        <input type="text" class="login-form " id="phon-input"
                            placeholder="Please Enter Your Phone Number">
                        <input type="text" class="login-form " id="email-input"
                            placeholder="Please Enter Your Email">
                    </div>
                    <div class="heading-role-div">
                        <h2 class="signup-heading">
                            Choose Your Role Here!
                        </h2>
                    </div>
                    <div class="kemedar-accordian" id="com_user-signup" onclick="togglecom_user_signup_options()">
                        <h4 class="kemedar-accordian-h4">
                            Common user <small>(Buyer, property seller, investor, community member)</small>
                            <span>
                                <i class="fa fa-plus plus" id="plus"></i>
                                <i class="fa fa-minus minus" id="minus"></i>
                            </span>
                        </h4>
                    </div>
                    <div id="com_user-signup_options" class="com_user-signup_options ">
                        <p>
                            I will mainly use kemedar in <small>(you can select as many as you can)</small>
                        </p>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox23" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox23">
                                    Search, buy or rent properties
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox3" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox3">
                                    Add, promote and sell my properties
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox4" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox4">
                                    Find handymen and carry out finishing tasks on my properties
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox5" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox5">
                                    Search and buy products for my home and construction
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox6" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox6">
                                    Know the most updated news in the real estate market
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox7" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox7">
                                    Learn profession and courses in the real estate industry to be handyman or
                                    professional realtor
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox8" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox8">
                                    Build my community in the real estate industry and communicate with people of
                                    the same interest
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox9" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox9">
                                    Invest my money buying shares in property using your kemedar Reits system
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="kemedar-accordian" id="professional_user-signup" onclick="togglepro_user_options()">
                        <h4 class="kemedar-accordian-h4">
                            Professional user <small>(handyman, marketer, freelancer, affiliate)</small>
                            <span>
                                <i class="fa fa-plus plus" id="plus2"></i>
                                <i class="fa fa-minus minus" id="minus2"></i>
                            </span>
                        </h4>
                    </div>
                    <div id="pro_user-signup_options" class="com_user-signup_options">
                        <p>
                            I will mainly use kemedar in <small>(you can select as many as you can)</small>
                        </p>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox10" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox10">
                                    All stated in common user +
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox11" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox11">
                                    Promote my services to your visitors to communicate and get orders from them
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox12" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox12">
                                    Use my profile on kemedar as my website page
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox13" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox13">
                                    Find good products and properties to do marketing by the affiliate system
                                </label>
                            </div>
                        </div>
                        <h5 class="pro-h5">
                            I am :
                        </h5>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox14" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox14">
                                    Handyman technician
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox15" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox15">
                                    Marketer
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox16" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox16">
                                    Affiliate
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox17" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox17">
                                    Freelancer
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="kemedar-accordian" id="business_user-signup" onclick="togglebus_user_options()">
                        <h4 class="kemedar-accordian-h4">
                            Business users <small>(Brokers, Real estate Agents, Real estate developers, finishing
                                companies)</small>
                            <span>
                                <i class="fa fa-plus plus" id="plus3"></i>
                                <i class="fa fa-minus minus" id="minus3"></i>
                            </span>
                        </h4>
                    </div>
                    <div id="bus_user-signup_options" class="com_user-signup_options">
                        <p>
                            I will mainly use kemedar in <small>(you can select as many as you can)</small>
                        </p>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox18" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox18">
                                    all stated in common user +
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox19" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox19">
                                    Promote my company properties, project, and services to your visitors
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox20" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox20">
                                    Managing my real estate business using your business tools
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox21" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox21">
                                    Using my profile page as my website page
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox22" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox22">
                                    Communicate with service providers, freelancers, marketer and affiliates to help
                                    me in my business and marketing operations
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox23" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox23">
                                    Advertise my company on your website pages
                                </label>
                            </div>
                        </div>
                        <h5 class="pro-h5">I am :</h5>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox24" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox24">
                                    Real estate Agent
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox25" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox25">
                                    Real estate developer
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox26" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox26">
                                    Finishing Company
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="kemedar-accordian" id="seller_user-signup" onclick="toggleseller_user_options()">
                        <h4 class="kemedar-accordian-h4">
                            Product Seller<small>(Through kemetro Ecommerce system)</small>
                            <span>
                                <i class="fa fa-plus plus" id="plus4"></i>
                                <i class="fa fa-minus minus" id="minus4"></i>
                            </span>
                        </h4>
                    </div>
                    <div id="seller_user-signup_options" class="com_user-signup_options">
                        <p>
                            I will mainly use kemedar in <small>(you can select as many as you can)</small>
                        </p>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox27" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox27">
                                    Create my own online shop on your ecommerce portal system for real estate home
                                    construction, finishing, and furnishing products
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox28" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox28">
                                    Promote my products and get orders from your visitors
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox29" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox29">
                                    Allow me to accept all payment methods that you can offer for your visitors
                                    including online and offline payments
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox30" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox30">
                                    Communicate with service providers, feelancers, marketer and affiliate to help
                                    me in my business and marketing operations
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox31" class="disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox31">
                                    Using my store page on kemetro as my website page
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="kemedar-accordian" id="shipper_user-signup" onclick="toggleshipper_user_options()">
                        <h4 class="kemedar-accordian-h4">
                            Product Shipper <small>(Through kemetro Ecommerce system)</small>
                            <span>
                                <i class="fa fa-plus plus" id="plus5"></i>
                                <i class="fa fa-minus minus" id="minus5"></i>
                            </span>
                        </h4>
                    </div>
                    <div id="shipper_user-signup_options" class="com_user-signup_options">
                        <p>
                            I will mainly use kemedar in <small>(you can select as many as you can)</small>
                        </p>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox32" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox32">
                                    Offer shipping and delivery service for kemetro products to the buyers of
                                    kemetro
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="kemedar-accordian" id="trainer_user-signup" onclick="toggletrainer_user_options()">
                        <h4 class="kemedar-accordian-h4">
                            Instructor or trainer<small>(through Kemecademy training &amp; education system)</small>
                            <span>
                                <i class="fa fa-plus plus" id="plus6"></i>
                                <i class="fa fa-minus minus" id="minus6"></i>
                            </span>
                        </h4>
                    </div>
                    <div id="instr_user-signup_options" class="com_user-signup_options">
                        <p>
                            I will mainly use kemedar in <small>(you can select as many as you can)</small>
                        </p>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox33" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox33">
                                    Give courses, lectures or training to the learners of your users
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox34" class="accordian_checkbox disply-inline" type="checkbox">
                                <label class="user-role-options-lable" for="checkbox34">
                                    Manage all my teaching and training activities, lessons, classes,
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkbox-div " style="margin-top:1.5rem;">
                    <input id="checkbox1" class="" type="checkbox">
                    <label class=" " for="checkbox1">
                        Agree with
                        <a class="lable-a" href="#">Privacy Policy</a>
                    </label>

                </div>
                <button class=" btn-login " type="submit">Create Account</button>
                <h6 class="text-login"> Or Signup with</h6>
                <div class="social-login-div signup-social">
                    <a href="">
                        <span>
                            <i class="fa fa-linkedin"></i>
                        </span>
                        Linkedin
                    </a>
                    <a href="">
                        <span>
                            <i class="fa fa-twitter"></i>
                        </span>
                        Twitter
                    </a>
                    <a href="">
                        <span>
                            <i class="fa fa-facebook"></i>
                        </span>
                        Facebook
                    </a>
                    <a href="">
                        <span>
                            <i class="fa fa-google" style="color: #dc3545 !important; font-size: 13px;"></i>
                        </span>
                        Google
                    </a>
                </div>
                <p class="login-last-line"> Already have an account?
                    <span class="">
                        <a href="">Sign in</a>
                    </span>
                </p>
            </form>
        </div>
    </div>
</div>
   