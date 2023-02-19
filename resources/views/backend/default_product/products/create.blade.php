@extends('backend.layouts.app')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@section('content')

    @php
        CoreComponentRepository::instantiateShopRepository();
        CoreComponentRepository::initializeCache();
    @endphp

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{translate('Add New Default Product')}}</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" action="{{route('defaults_products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
            <div class="row gutters-5">
                <div class="col-lg-8">
                    @csrf
                    <input type="hidden" name="added_by" value="admin">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Product Information')}}</h5>
                        </div>
                        <div class="card-body">


                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Product Name')}} <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" placeholder="{{ translate('Product Name') }}" onchange="update_sku()" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" id="category">
                                <label class="col-md-3 col-from-label">{{translate('Category')}} <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" name="category_ids[]" id="category_id" data-live-search="true" onchange="getDefaultAttribute()" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ translate($category->name) }}</option>
                                            @foreach ($category->childrenCategories as $childCategory)
                                                @include('categories.child_category', ['child_category' => $childCategory])
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="brand">
                                <label class="col-md-3 col-from-label">{{translate('Brand')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">
                                        <option value="">{{ translate('Select Brand') }}</option>
                                        @foreach (\App\Models\Brand::where('verify', 1)->where('user_id' , 1)->get() as $brand)
                                            <option value="{{ $brand->id }}">{{ translate($brand->name) }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('brand_id'))
                                        <span class="error text-danger">{{ $errors->first('brand_id') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Unit')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="unit" placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}" value="{{old('unit')}}">
                                    @if ($errors->has('unit'))
                                        <span class="error text-danger">{{ $errors->first('unit') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Weight')}} <small>({{ translate('In Kg') }})</small></label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="weight" step="0.01" value="0.00" placeholder="0.00">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Minimum Purchase Qty')}} <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="number" lang="en" class="form-control" name="min_qty" value="1" min="1">
                                    @if ($errors->has('min_qty'))
                                        <span class="error text-danger">{{ $errors->first('min_qty') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Tags')}} <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control aiz-tag-input" name="tags[]" placeholder="{{ translate('Type and hit enter to add a tag') }}">
                                    <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>
                                </div>
                            </div>

                        <!-- @if (addon_is_activated('pos_system')) -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Barcode')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="{{ translate('Generate by auto') }}" disabled>
                                </div>
                            </div>
                        <!-- @endif -->

                            @if (addon_is_activated('refund_request'))
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Refundable')}}</label>
                                    <div class="col-md-8">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="checkbox" name="refundable" checked value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Product Images')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Gallery Images')}} <small>(600x600)</small></label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="photos" class="selected-files">
                                    </div>

                                    <!-- ekhane thekeii image preview hocche ajax er maddhome -->
                                    <div class="file-preview box sm">
                                    </div>
                                    <!-- End -->

                                    <small class="text-muted">{{translate('These images are visible in product details page gallery. Use 600x600 sizes images.')}}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Thumbnail Image')}} <small>(300x300)</small></label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="thumbnail_img" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                    <small class="text-muted">{{translate('This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Product Videos')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Video Provider')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">
                                        <option value="youtube">{{translate('Youtube')}}</option>
                                        <option value="dailymotion">{{translate('Dailymotion')}}</option>
                                        <option value="vimeo">{{translate('Vimeo')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Video Link')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="video_link" placeholder="{{ translate('Video Link') }}">
                                    <small class="text-muted">{{translate("Use proper link without extra parameter. Don't use short share link/embeded iframe code.")}}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Product Variation')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row gutters-5">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="{{translate('Colors')}}" disabled>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple disabled>
                                        @foreach (\App\Models\Color::orderBy('name', 'asc')->get() as $key => $color)
                                        <option  value="{{ $color->code }}" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}'></span><span>{{ $color->name }}</span></span>"></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input value="1" type="checkbox" name="colors_active">
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row gutters-5">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>
                                </div>
                                <div class="col-md-8">
                                    <select name="choice_attributes[]" id="choice_attributes" class="form-control aiz-selectpicker" data-selected-text-format="count" data-live-search="true" multiple data-placeholder="{{ translate('Choose Attributes') }}" onchange="getChoice()">
                                    </select>
                                </div>
                            </div>
                            <div>
                                <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>
                                <br>
                            </div>

                            <div class="form-group row gutters-5">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="{{translate('Choice')}}" disabled>
                                </div>
                                <div class="col-md-8">
                                    <select name="choice_options[]" id="choice_options" class="form-control aiz-selectpicker" data-live-search="true" multiple data-placeholder="{{ translate('Choose Value') }}" onchange="update_sku2()">
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="customer_choice_options" id="customer_choice_options">

                            </div> --}}
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Product price + stock')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Unit price')}} <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Unit price') }}" name="unit_price" class="form-control">
                                    @if ($errors->has('unit_price'))
                                        <span class="error text-danger">{{ $errors->first('unit_price') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label" for="start_date">{{translate('Discount Date Range')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="{{translate('Select Date')}}" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Discount')}} <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Discount') }}" name="discount" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control aiz-selectpicker" name="discount_type">
                                        <option value="amount">{{translate('Flat')}}</option>
                                        <option value="percent">{{translate('Percent')}}</option>
                                    </select>
                                </div>
                            </div>

                            @if(addon_is_activated('club_point'))
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">
                                        {{translate('Set Point')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="number" lang="en" min="0" value="0" step="1" placeholder="{{ translate('1') }}" name="earn_point" class="form-control">
                                    </div>
                                </div>
                            @endif

                            <div id="show-hide-div">
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Quantity')}} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" lang="en" min="0" value="0" step="1" placeholder="{{ translate('Quantity') }}" name="current_stock" class="form-control">
                                        @if ($errors->has('current_stock'))
                                            <span class="error text-danger">{{ $errors->first('current_stock') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">
                                        {{translate('SKU')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="{{ translate('SKU') }}"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">
                                    {{translate('External link')}}
                                </label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="{{ translate('External link') }}" name="external_link" class="form-control">
                                    <small class="text-muted">{{translate('Leave it blank if you do not use external site link')}}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">
                                    {{translate('External link button text')}}
                                </label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="{{ translate('External link button text') }}" name="external_link_btn" class="form-control">
                                    <small class="text-muted">{{translate('Leave it blank if you do not use external site link')}}</small>
                                </div>
                            </div>
                            <br>
                            <div class="sku_combination" id="sku_combination"></div>
                            <div class="sku_combination" id="sku_combination2"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Product Description')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Description')}}</label>
                                <div class="col-md-8">
                                    <textarea id="summernote" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                <!--<div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Product Shipping Cost')}}</h5>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>-->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('PDF Specification')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('PDF Specification')}}</label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="document" data-multiple="true">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="pdf" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('SEO Meta Tags')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Meta Title')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="meta_title" placeholder="{{ translate('Meta Title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{translate('Description')}}</label>
                                <div class="col-md-8">
                                    <textarea name="meta_description" rows="8" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Meta Image') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="meta_img" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">
                                {{translate('Shipping Configuration')}}
                            </h5>
                        </div>

                        <div class="card-body">
                            @if (get_setting('shipping_type') == 'product_wise_shipping')
                                <div class="form-group row">
                                    <label class="col-md-6 col-from-label">{{translate('Free Shipping')}}</label>
                                    <div class="col-md-6">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="radio" name="shipping_type" value="free" checked>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-6 col-from-label">{{translate('Flat Rate')}}</label>
                                    <div class="col-md-6">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="radio" name="shipping_type" value="flat_rate">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="flat_rate_shipping_div" style="display: none">
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label">{{translate('Shipping cost')}}</label>
                                        <div class="col-md-6">
                                            <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-6 col-from-label">{{translate('Is Product Quantity Mulitiply')}}</label>
                                    <div class="col-md-6">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="checkbox" name="is_quantity_multiplied" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            @else
                                <p>
                                    {{ translate('Product wise shipping cost is disable. Shipping cost is configured from here') }}
                                    <a href="{{route('shipping_configuration.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])}}">
                                        <span class="aiz-side-nav-text">{{translate('Shipping Configuration')}}</span>
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>


                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">
                            {{translate('Shipping From')}}
                        </h5>
                    </div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label" for="type">
                                    {{translate('Country')}}
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control aiz-selectpicker" data-live-search="true" name="country_id" id="country_id">
                                        <option value="">{{translate('Select Country')}}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('country_id'))
                                        <span class="error text-danger">{{ $errors->first('country_id') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('City')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_id">

                                    </select>

                                    @if ($errors->has('state_id'))
                                        <span class="error text-danger">{{ $errors->first('state_id') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('District')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id">

                                    </select>


                                    @if ($errors->has('city_id'))
                                        <span class="error text-danger">{{ $errors->first('city_id') }}</span>
                                    @endif

                                </div>
                            </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">
                            {{translate('Shipping To')}}
                        </h5>
                    </div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label" for="type">
                                    {{translate('Country')}}
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control aiz-selectpicker" data-live-search="true" name="country_to_id" id="country_to_id">
                                        <option value="">{{translate('Select Country')}}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('country_to_id'))
                                        <span class="error text-danger">{{ $errors->first('country_to_id') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('City')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_to_id">

                                    </select>

                                    @if ($errors->has('state_to_id'))
                                        <span class="error text-danger">{{ $errors->first('state_to_id') }}</span>
                                    @endif


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('District')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_to_id[]" multiple>
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Low Stock Quantity Warning')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">
                                    {{translate('Quantity')}}
                                </label>
                                <input type="number" name="low_stock_quantity" value="1" min="0" step="1" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">
                                {{translate('Stock Visibility State')}}
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{translate('Show Stock Quantity')}}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="radio" name="stock_visibility_state" value="quantity" checked>
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{translate('Show Stock With Text Only')}}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="radio" name="stock_visibility_state" value="text">
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{translate('Hide Stock')}}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="radio" name="stock_visibility_state" value="hide">
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Cash On Delivery')}}</h5>
                        </div>
                        <div class="card-body">
                            @if (get_setting('cash_payment') == '1')
                                <div class="form-group row">
                                    <label class="col-md-6 col-from-label">{{translate('Status')}}</label>
                                    <div class="col-md-6">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="checkbox" name="cash_on_delivery" value="1" checked="">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            @else
                                <p>
                                    {{ translate('Cash On Delivery option is disabled. Activate this feature from here') }}
                                    <a href="{{route('activation.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])}}">
                                        <span class="aiz-side-nav-text">{{translate('Cash Payment Activation')}}</span>
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Featured')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{translate('Status')}}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" name="featured" value="1">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Todays Deal')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{translate('Status')}}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" name="todays_deal" value="1">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Flash Deal')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">
                                    {{translate('Add To Flash')}}
                                </label>
                                <select class="form-control aiz-selectpicker" name="flash_deal_id" id="flash_deal">
                                    <option value="">{{ translate('Choose Flash Title') }}</option>
                                    @foreach(\App\Models\FlashDeal::where("status", 1)->get() as $flash_deal)
                                        <option value="{{ $flash_deal->id}}">
                                            {{ $flash_deal->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">
                                    {{translate('Discount')}}
                                </label>
                                <input type="number" name="flash_discount" value="0" min="0" step="0.01" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">
                                    {{translate('Discount Type')}}
                                </label>
                                <select class="form-control aiz-selectpicker" name="flash_discount_type" id="flash_discount_type">
                                    <option value="">{{ translate('Choose Discount Type') }}</option>
                                    <option value="amount">{{translate('Flat')}}</option>
                                    <option value="percent">{{translate('Percent')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('Estimate Shipping Time')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">
                                    {{translate('Shipping Days')}}
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="est_shipping_days" min="1" step="1" placeholder="{{translate('Shipping Days')}}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">{{translate('Days')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{translate('VAT & Tax')}}</h5>
                        </div>
                        <div class="card-body">
                            @foreach(\App\Models\Tax::where('tax_status', 1)->get() as $tax)
                                <label for="name">
                                    {{$tax->name}}
                                    <input type="hidden" value="{{$tax->id}}" name="tax_id[]">
                                </label>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select class="form-control aiz-selectpicker" name="tax_type[]">
                                            <option value="amount">{{translate('Flat')}}</option>
                                            <option value="percent">{{translate('Percent')}}</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="Third group">
                            <button type="submit" name="button" value="unpublish" class="btn btn-primary action-btn">{{ translate('Save & Unpublish') }}</button>
                        </div>
                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" name="button" value="publish" class="btn btn-success action-btn">{{ translate('Save & Publish') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('kemetro_script')

    <script type="text/javascript">
        $('form').bind('submit', function (e) {
            if ( $(".action-btn").attr('attempted') == 'true' ) {
                //stop submitting the form because we have already clicked submit.
                e.preventDefault();
            }
            else {
                $(".action-btn").attr("attempted", 'true');
            }
            // Disable the submit button while evaluating if the form should be submitted
            // $("button[type='submit']").prop('disabled', true);

            // var valid = true;

            // if (!valid) {
            // e.preventDefault();

            ////Reactivate the button if the form was not submitted
            // $("button[type='submit']").button.prop('disabled', false);
            // }
        });

        $("[name=shipping_type]").on("change", function (){
            $(".flat_rate_shipping_div").hide();

            if($(this).val() == 'flat_rate'){
                $(".flat_rate_shipping_div").show();
            }

        });



        </script>


<script>
    function getDefaultAttribute(){
        var category_id=$("#category_id").val();
        $.ajax({
                url: "{{ route('defaults_products.getDefaultAttributes') }}",
                method: "GET",
                data: {
                    "category_id": category_id
                },
                success: function(result) {
                    //alert(JSON.stringify(result));
                    $('#choice_attributes').html(result);
                    $('#colors').prop('disabled', false);
                        AIZ.plugins.bootstrapSelect('refresh');
                },
                error: function(response) {
                    //alert(JSON.stringify(response));
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                }
            });
        }

    function getChoiceOptions(){
        var choice_attributes=$("#choice_attributes").val();

        $.ajax({
                url: "{{ route('defaults_products.add-more-choice-option') }}",
                method: "GET",
                data: {
                    "choice_attributes": choice_attributes
                },
                success: function(result) {
                    //alert(JSON.stringify(result));
                    $('#customer_choice_options').html(result);
                },
                error: function(response) {
                    //(JSON.stringify(response));
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                }
            });
        }

        function getChoice(){
            var attribute_id=$("#choice_attributes").val();
            //alert(attribute_id);
            $.ajax({
                    url: "{{ route('products.get-choice-option') }}",
                    method: "get",
                    data: {
                        "attribute_id": attribute_id
                    },
                    success: function(result) {
                        //alert(JSON.stringify(result));
                        $('#choice_options').html(result);
                            AIZ.plugins.bootstrapSelect('refresh');
                    },
                    error: function(response) {
                        //alert(JSON.stringify(response));
                    },
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    complete: function() {
                        $('#loading').hide();
                    }
                });
            }




        function update_sku2() {
            var choiceOptions=$('#choice_options').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('products.sku_combimnation2') }}",
                    method: "POST",
                    data:$('#choice_form').serialize(),
                    success: function(result) {
                        //alert(JSON.stringify(result));
                        $('#sku_combination2').html(result);
                        AIZ.uploader.previewGenerate();
                        AIZ.plugins.fooTable();
                        if (result.length > 1) {
                            $('#show-hide-div2').hide();
                        }
                        else {
                            $('#show-hide-div2').show();
                        }

                    },
                    error: function(response) {
                        //alert(JSON.stringify(response));
                    },
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    complete: function() {
                        $('#loading').hide();
                    }
                });
        };


        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function(){
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
            update_sku();
        });



        function add_more_customer_choice_option(i, name){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url:'{{ route('defaults_products.add-more-choice-option') }}',
                    data:{
                    attribute_id: i
                    },
                    success: function(data) {
                        var obj = JSON.parse(data);
                        $('#customer_choice_options').append('\
                        <div class="form-group row">\
                            <div class="col-md-3">\
                                <input type="hidden" name="choice_no[]" value="'+i+'">\
                                <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="{{ translate('Choice Title') }}" readonly>\
                            </div>\
                            <div class="col-md-8">\
                                <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" id="choice_options" onchange="getSku()" multiple>\
                                    '+obj+'\
                                </select>\
                            </div>\
                        </div>');
                        AIZ.plugins.bootstrapSelect('refresh');
                }
            });
        }




        function update_sku(){
            $.ajax({
                type:"POST",
                url:'{{ route('products.sku_combination') }}',
                data:$('#choice_form').serialize(),
                success: function(data) {
                   // alert(JSON.stringify(data));
                    $('#sku_combination').html(data);
                    AIZ.uploader.previewGenerate();
                    AIZ.plugins.fooTable();
                    if (data.length > 1) {
                        $('#show-hide-div').hide();
                    }
                    else {
                        $('#show-hide-div').show();
                    }
                    update_sku2();
                }
            });
        }



        $('input[name="colors_active"]').on('change', function() {
            if(!$('input[name="colors_active"]').is(':checked')) {
                $('#colors').prop('disabled', true);
                AIZ.plugins.bootstrapSelect('refresh');
            }
            else {
                $('#colors').prop('disabled', false);
                AIZ.plugins.bootstrapSelect('refresh');
            }
            update_sku();
        });

        $(document).on("change", ".attribute_choice",function() {
            update_sku();
        });

        $('#colors').on('change', function() {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function() {
            update_sku();
            update_sku2();
        });

        $('input[name="name"]').on('keyup', function() {
            update_sku();
        });

        function delete_row(em){
            $(em).closest('.form-group row').remove();
            update_sku();
        }

        function delete_variant(em){
            $(em).closest('.variant').remove();
        }


        function getSku(){
            var choice_options=$('#choice_options').val();
            $.ajax({
                url: "{{ route('defaults_products.getSku') }}",
                method: "GET",
                data: {
                    "choice_options": choice_options
                },
                success: function(result) {
                    //alert(JSON.stringify(result));

                },
                error: function(response) {
                   // alert(JSON.stringify(response));
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                }
            });
        }

        //Shipping From & Shipping To Start
        // state dristric
        (function($) {
			"use strict";
            $(document).on('change', '[name=country_id]', function() {
                var country_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('get-state-frontend')}}",
                    type: 'POST',
                    data: {
                        country_id  : country_id
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if(obj != '') {
                            $('[name="state_id"]').html(obj);
                            AIZ.plugins.bootstrapSelect('refresh');
                        }
                    }
                });
            });

            $(document).on('change', '[name=state_id]', function() {
                var state_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('get-city-frontend')}}",
                    type: 'POST',
                    data: {
                        state_id: state_id
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if(obj != '') {
                            $('[name="city_id"]').html(obj);
                            AIZ.plugins.bootstrapSelect('refresh');
                        }
                    }
                });
            });
        })(jQuery);

        // Shipping to
        // state dristric
        (function($) {
			"use strict";
            $(document).on('change', '[name=country_to_id]', function() {
                var country_to_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('get-to-state-frontend')}}",
                    type: 'POST',
                    data: {
                        country_to_id  : country_to_id
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if(obj != '') {
                            $('[name="state_to_id"]').html(obj);
                            AIZ.plugins.bootstrapSelect('refresh');
                        }
                    }
                });
            });

            $(document).on('change', '[name=state_to_id]', function() {
                var state_to_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('get-to-city-frontend')}}",
                    type: 'POST',
                    data: {
                        state_to_id: state_to_id
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if(obj != '') {
                            $('[name="city_to_id[]"]').html(obj);
                            AIZ.plugins.bootstrapSelect('refresh');
                        }
                    }
                });
            });
        })(jQuery);
        //Shipping From & Shipping To End


</script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>
@endsection


