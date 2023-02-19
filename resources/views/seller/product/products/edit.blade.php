@extends('seller.layouts.app')

@section('panel_content')

<div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Update your product') }}</h1>
        </div>
    </div>
</div>

<form class="" action="{{route('seller.products.update', $product->id)}}" method="POST" enctype="multipart/form-data"
    id="choice_form">
    <div class="row gutters-5">
        <div class="col-lg-8">
            <input name="_method" type="hidden" value="POST">
            <input type="hidden" name="lang" value="{{ $lang }}">
            <input type="hidden" name="id" value="{{ $product->id }}">
            @csrf
            <input type="hidden" name="added_by" value="seller">
            <div class="card">
                <ul class="nav nav-tabs nav-fill border-light">
{{--                    @foreach (\App\Models\Language::all() as $key => $language)--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"--}}
{{--                            href="{{ route('seller.products.edit', ['id'=>$product->id, 'lang'=> $language->code] ) }}">--}}
{{--                            <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11"--}}
{{--                                class="mr-1">--}}
{{--                            <span>{{$language->name}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    @endforeach--}}
                </ul>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Product Name')}}</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="name"
                                placeholder="{{translate('Product Name')}}" value="{{$product->getTranslation('name',$lang)}}"
                                required>

                        @if ($errors->has('name'))
                            <span class="error text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row" id="category">
                        <label class="col-lg-3 col-from-label">{{translate('Category')}}</label>
                        <div class="col-lg-8">

                            <select class="form-control aiz-selectpicker" name="category_ids[]" id="category_id"  data-live-search="true" required multiple onchange="get_attribute()">
                                @foreach($productCategories as $productCategory)
                                    <option value="{{ $productCategory->category_id }}" selected>{{ translate($productCategory->name) }}</option>
                                @endforeach
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ translate($category->name) }}</option>
                                    @foreach ($category->childrenCategories as $childCategory)
                                        @include('categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                @endforeach
                            </select>
{{--                            <select class="form-control aiz-selectpicker" name="category_id" id="category_id"--}}
{{--                                data-selected="{{ $product->category_id }}" data-live-search="true" required>--}}
{{--                                @foreach ($categories as $category)--}}
{{--                                <option value="{{ $category->id }}">{{ translate($category->name) }}</option>--}}
{{--                                @foreach ($category->childrenCategories as $childCategory)--}}
{{--                                @include('categories.child_category', ['child_category' => $childCategory])--}}
{{--                                @endforeach--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
                        </div>
                    </div>
                    <div class="form-group row" id="brand">
                        <label class="col-lg-3 col-from-label">{{translate('Brand')}}</label>
                        <div class="col-lg-8">
                            <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id">
                                <option value="">{{ translate('Select Brand') }}</option>
                                @foreach (\App\Models\Brand::where('verify', 1)->get() as $brand)
                                <option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected
                                    @endif>{{ translate($brand->name) }}</option>
                                @endforeach

                                <!-- @foreach (\App\Models\Brand::where('verify', 1)->where('user_id' , Auth::id())->get() as $brand)
                                    <option value="{{ $brand->id }}">{{ translate($brand->name) }}</option>
                                @endforeach
                                @foreach (\App\Models\Brand::where('user_id' , 1)->get() as $brand)
                                    <option value="{{ $brand->id }}">{{ translate($brand->name) }}</option>
                                @endforeach -->

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Unit')}}</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="unit"
                                placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}"
                                value="{{$product->getTranslation('unit')}}" required>
                            @if ($errors->has('unit'))
                                    <span class="error text-danger">{{ $errors->first('unit') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Weight')}} <small>({{ translate('In Kg') }})</small></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="weight" value="{{ $product->weight }}" step="0.01" placeholder="0.00">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Minimum Purchase Qty')}}</label>
                        <div class="col-lg-8">
                            <input type="number" lang="en" class="form-control" name="min_qty"
                                value="@if($product->min_qty <= 1){{1}}@else{{$product->min_qty}}@endif" min="1"
                                required>

                        @if ($errors->has('min_qty'))
                            <span class="error text-danger">{{ $errors->first('min_qty') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Tags')}}</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control aiz-tag-input" name="tags[]" id="tags"
                                value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}"
                                data-role="tagsinput">
                        </div>
                    </div>

                    @if (addon_is_activated('pos_system'))
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Barcode')}}</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="barcode"
                                placeholder="{{ translate('Barcode') }}" value="{{ $product->barcode }}">
                        </div>
                    </div>
                    @endif

                    @if (addon_is_activated('refund_request'))
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{translate('Refundable')}}</label>
                        <div class="col-lg-8">
                            <label class="aiz-switch aiz-switch-success mb-0" style="margin-top:5px;">
                                <input type="checkbox" name="refundable" @if ($product->refundable == 1) checked @endif value="1">
                                <span class="slider round"></span></label>
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
                        <label class="col-md-3 col-form-label"
                            for="signinSrEmail">{{translate('Gallery Images')}}</label>
                        <div class="col-md-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="photos" value="{{ $product->photos }}"
                                    class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Thumbnail Image')}}
                            <small>(290x300)</small></label>
                        <div class="col-md-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="thumbnail_img" value="{{ $product->thumbnail_img }}"
                                    class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                            <label class="col-lg-3 col-from-label">{{translate('Gallery Images')}}</label>
                    <div class="col-lg-8">
                        <div id="photos">
                            @if(is_array(json_decode($product->photos)))
                            @foreach (json_decode($product->photos) as $key => $photo)
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="img-upload-preview">
                                    <img loading="lazy" src="{{ uploaded_asset($photo) }}" alt=""
                                        class="img-responsive">
                                    <input type="hidden" name="previous_photos[]" value="{{ $photo }}">
                                    <button type="button" class="btn btn-danger close-btn remove-files"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="form-group row">
                            <label class="col-lg-3 col-from-label">{{translate('Thumbnail Image')}}
                <small>(290x300)</small></label>
                <div class="col-lg-8">
                    <div id="thumbnail_img">
                        @if ($product->thumbnail_img != null)
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img loading="lazy" src="{{ uploaded_asset($product->thumbnail_img) }}" alt=""
                                    class="img-responsive">
                                <input type="hidden" name="previous_thumbnail_img"
                                    value="{{ $product->thumbnail_img }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Product Videos')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Video Provider')}}</label>
                <div class="col-lg-8">
                    <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">
                        <option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?>>
                            {{translate('Youtube')}}</option>
                        <option value="dailymotion"
                            <?php if($product->video_provider == 'dailymotion') echo "selected";?>>
                            {{translate('Dailymotion')}}</option>
                        <option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?>>
                            {{translate('Vimeo')}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Video Link')}}</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}"
                        placeholder="{{ translate('Video Link') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Product Variation')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-3">
                    <input type="text" class="form-control" value="{{translate('Colors')}}" disabled>
                </div>
                <div class="col-lg-8">
                    <select class="form-control aiz-selectpicker" data-live-search="true"
                        data-selected-text-format="count" name="colors[]" id="colors" multiple>
                        @foreach (\App\Models\Color::orderBy('name', 'asc')->get() as $key => $color)
                        <option value="{{ $color->code }}"
                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}'></span><span>{{ $color->name }}</span></span>"
                            <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?>></option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-1">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input value="1" type="checkbox" name="colors_active"
                            <?php if(count(json_decode($product->colors)) > 0) echo "checked";?>>
                        <span></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-3">
                    <input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>
                </div>
                <div class="col-lg-8">
                    <select name="choice_attributes[]" data-live-search="true" data-selected-text-format="count"
                        id="choice_attributes" class="form-control aiz-selectpicker" multiple
                        data-placeholder="{{ translate('Choose Attributes') }}">
                        @foreach($productAttributes as $productAttribute)
                            <option value="{{ $productAttribute->attribute_id }}" selected>{{ translate($productAttribute->name) }}</option>
                        @endforeach
                        @foreach (\App\Models\Attribute::where('verify', 1)->get() as $key => $attribute)
                        <option value="{{ $attribute->id }}" @if($product->attributes != null &&
                            in_array($attribute->id, json_decode($product->attributes, true))) selected
                            @endif>{{ translate($attribute->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="">
                <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>
                <br>
            </div>


            <div class="form-group row gutters-5">
                <div class="col-md-3">
                    <input type="text" class="form-control" value="{{translate('Choice')}}" disabled>
                </div>
                <div class="col-md-8">
                    <select name="choice_options[]" id="choice_options" class="form-control aiz-selectpicker"  data-selected-text-format="count" data-live-search="true" multiple data-placeholder="{{ translate('Choose Value') }}" onchange="update_sku2()">
                        @foreach($productChoices as $choice)
                        <option value="{{$choice->value}}" selected>{{$choice->valueName}}</option>
                        @endforeach
                        @foreach($attributeChoices as $choice)
                        <option value="{{$choice->slug}}">{{$choice->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="customer_choice_options" id="customer_choice_options">
                @foreach (json_decode($product->choice_options) as $key => $choice_option)
                <div class="form-group row">
                    <div class="col-lg-3">
                        <input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
                        <input type="text" class="form-control" name="choice[]"
                            value="{{ translate(\App\Models\Attribute::find($choice_option->attribute_id)->name) }}"
                            placeholder="{{ translate('Choice Title') }}" disabled>
                    </div>
                    <div class="col-lg-8">
                        <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_{{ $choice_option->attribute_id }}[]" multiple>
                            @foreach (\App\Models\AttributeValue::where('attribute_id', $choice_option->attribute_id)->get() as $row)
                                <option value="{{ $row->value }}" @if( in_array($row->value, $choice_option->values)) selected @endif>
                                    {{ $row->value }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-control aiz-tag-input" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="{{ translate('Enter choice values') }}" value="{{ implode(',', $choice_option->values) }}" data-on-change="update_sku"> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Product price + stock')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Unit price')}}</label>
                <div class="col-lg-6">
                    <input type="text" placeholder="{{translate('Unit price')}}" name="unit_price" class="form-control"
                        value="{{$product->unit_price}}" required>
                        @if ($errors->has('unit_price'))
                            <span class="error text-danger">{{ $errors->first('unit_price') }}</span>
                        @endif
                </div>
            </div>

            @php
                $date_range = '';
                if($product->discount_start_date){
                    $start_date = date('d-m-Y H:i:s', $product->discount_start_date);
                    $end_date = date('d-m-Y H:i:s', $product->discount_end_date);
                    $date_range = $start_date.' to '.$end_date;
                }
            @endphp

            <div class="form-group row">
                <label class="col-lg-3 col-from-label" for="start_date">{{translate('Discount Date Range')}}</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control aiz-date-range" value="{{ $date_range }}" name="date_range" placeholder="{{translate('Select Date')}}" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Discount')}}</label>
                <div class="col-lg-6">
                    <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Discount')}}"
                        name="discount" class="form-control" value="{{ $product->discount }}" required>

                    @if ($errors->has('discount'))
                            <span class="error text-danger">{{ $errors->first('discount') }}</span>
                    @endif
                </div>
                <div class="col-lg-3">
                    <select class="form-control aiz-selectpicker" name="discount_type" required>
                        <option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?>>
                            {{translate('Flat')}}</option>
                        <option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?>>
                            {{translate('Percent')}}</option>
                    </select>
                </div>
            </div>

            <div id="show-hide-div">
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label">{{translate('Quantity')}}</label>
                    <div class="col-lg-6">
                        <input type="number" lang="en" value="{{ $product->stocks->first()->qty }}" step="1"
                            placeholder="{{translate('Quantity')}}" name="current_stock" class="form-control">
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
                        <input type="text" placeholder="{{ translate('SKU') }}" value="{{ $product->stocks->first()->sku }}" name="sku" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-from-label">
                    {{translate('External link')}}
                </label>
                <div class="col-md-9">
                    <input type="text" placeholder="{{ translate('External link') }}" name="external_link" value="{{ $product->external_link }}" class="form-control">
                    <small class="text-muted">{{translate('Leave it blank if you do not use external site link')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-from-label">
                    {{translate('External link button text')}}
                </label>
                <div class="col-md-9">
                    <input type="text" placeholder="{{ translate('External link button text') }}" name="external_link_btn" value="{{ $product->external_link_btn }}" class="form-control">
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
                <label class="col-lg-3 col-from-label">{{translate('Description')}}</label>
                <div class="col-lg-9">
                    <textarea class="aiz-text-editor"
                        name="description">{{$product->getTranslation('description',$lang)}}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('PDF Specification')}}</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('PDF Specification')}}</label>
                <div class="col-md-8">
                    <div class="input-group" data-toggle="aizuploader">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}
                            </div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="pdf" value="{{ $product->pdf }}" class="selected-files">
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
                <label class="col-lg-3 col-from-label">{{translate('Meta Title')}}</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}"
                        placeholder="{{translate('Meta Title')}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-from-label">{{translate('Description')}}</label>
                <div class="col-lg-8">
                    <textarea name="meta_description" rows="8"
                        class="form-control">{{ $product->meta_description }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Meta Images')}}</label>
                <div class="col-md-8">
                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}
                            </div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="meta_img" value="{{ $product->meta_img }}" class="selected-files">
                    </div>
                    <div class="file-preview box sm">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">{{translate('Slug')}}</label>
                <div class="col-lg-8">
                    <input type="text" placeholder="{{translate('Slug')}}" id="slug" name="slug"
                        value="{{ $product->slug }}" class="form-control">
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6" class="dropdown-toggle" data-toggle="collapse" data-target="#collapse_2">
                    {{translate('Shipping Configuration')}}
                </h5>
            </div>
            <div class="card-body collapse show" id="collapse_2">
                @if (get_setting('shipping_type') == 'product_wise_shipping')
                <div class="form-group row">
                    <label class="col-lg-6 col-from-label">{{translate('Free Shipping')}}</label>
                    <div class="col-lg-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="shipping_type" value="free" @if($product->shipping_type == 'free')
                            checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-6 col-from-label">{{translate('Flat Rate')}}</label>
                    <div class="col-lg-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="shipping_type" value="flat_rate" @if($product->shipping_type ==
                            'flat_rate') checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="flat_rate_shipping_div" style="display: none">
                    <div class="form-group row">
                        <label class="col-lg-6 col-from-label">{{translate('Shipping cost')}}</label>
                        <div class="col-lg-6">
                            <input type="number" lang="en" min="0" value="{{ $product->shipping_cost }}" step="0.01"
                                placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost"
                                class="form-control">
                        </div>
                    </div>
                </div>


                @else
                <p>
                    {{ translate('Shipping configuration is maintained by Admin.') }}
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
                        <select class="form-control aiz-selectpicker" data-live-search="true" name="country_id" id="country_id" required>
                            <option value="">{{translate('Select Country')}}</option>
                            @foreach($productShippingfroms as $productShippingfrom)
                                <option value="{{ \App\Models\Country::where('name','=', $productShippingfrom->from_country)->first()->id}}" selected>{{ \App\Models\Country::where('name','=', $productShippingfrom->from_country)->first()->name }}</option>
                            @endforeach
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
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_id" required>
                            @foreach($productShippingfroms as $productShippingfrom)
                                <option value="{{ \App\Models\State::where('name','=', $productShippingfrom->from_city)->first()->id }}" selected>{{ \App\Models\State::where('name','=', $productShippingfrom->from_city)->first()->name }}</option>
                            @endforeach
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
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id" required>

                            @foreach($productShippingfroms as $productShippingfrom)
                                <option value="{{ \App\Models\City::where('name','=', $productShippingfrom->from_district)->first()->id }}" selected>{{ \App\Models\City::where('name','=', $productShippingfrom->from_district)->first()->name }}</option>
                            @endforeach
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
                        <select class="form-control aiz-selectpicker" data-live-search="true" name="country_to_id" id="country_to_id" required>
                            <option value="">{{translate('Select Country')}}</option>
                            @foreach($productShippingtos as $productShippingto)
                                <option value="{{ \App\Models\Country::where('name','=', $productShippingto->to_country)->first()->id }}" selected>{{ \App\Models\Country::where('name','=', $productShippingto->to_country)->first()->name }}</option>
                            @endforeach
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
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_to_id" required>
                            @foreach($productShippingtos as $productShippingto)
                                <option value="{{ \App\Models\State::where('name','=', $productShippingto->to_city)->first()->id }}" selected>{{ \App\Models\City::where('name','=', $productShippingto->to_city)->first()->name }}</option>
                            @endforeach
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
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_to_id[]" multiple required>
                            @foreach($productShippingtos as $productShippingto)
                                @php
                                    $district = $productShippingto->to_district;
                                    $district = str_replace(array('[','"',']' ), '',  $district);
                                   $file['file_name'] = explode(',', $district);
                                @endphp

                                @foreach($file['file_name'] as $item)
{{--                                    @if(\App\Models\ShippingCost::where('city_name','=', $item)->first()->cost)--}}
{{--                                        <option value="{{ \App\Models\City::where('name','=', $item)->first()->id }}" selected>{{ \App\Models\City::where('name','=', $item)->first()->name.' Shipping Cost is = '. \App\Models\ShippingCost::where('city_name','=', $item)->first()->cost }}</option>--}}
{{--                                    @else--}}
{{--                                        <option value="{{ \App\Models\City::where('name','=', $item)->first()->id }}" selected>{{ \App\Models\City::where('name','=', $item)->first()->name.' Shipping Cost is = '. \App\Models\City::where('name','=', $item)->first()->cost }}</option>--}}
{{--                                    @endif--}}
                                        <option value="{{ \App\Models\City::where('name','=', $item)->first()->id }}" selected>{{ \App\Models\City::where('name','=', $item)->first()->name.' Shipping Cost is = '. \App\Models\City::where('name','=', $item)->first()->cost }}</option>
                                @endforeach
                            @endforeach
                        </select>
                        @if ($errors->has('city_to_id'))
                            <span class="error text-danger">{{ $errors->first('city_to_id') }}</span>
                        @endif
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
                    <input type="number" name="low_stock_quantity" value="{{ $product->low_stock_quantity }}" min="0"
                        step="1" class="form-control">
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
                            <input type="radio" name="stock_visibility_state" value="quantity"
                                @if($product->stock_visibility_state == 'quantity') checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-6 col-from-label">{{translate('Show Stock With Text Only')}}</label>
                    <div class="col-md-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="stock_visibility_state" value="text"
                                @if($product->stock_visibility_state == 'text') checked @endif>
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-6 col-from-label">{{translate('Hide Stock')}}</label>
                    <div class="col-md-6">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="radio" name="stock_visibility_state" value="hide"
                                @if($product->stock_visibility_state == 'hide') checked @endif>
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
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-6 col-from-label">{{translate('Status')}}</label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="cash_on_delivery" value="1"
                                        @if($product->cash_on_delivery == 1) checked @endif>
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <p>
                    {{ translate('Cash On Delivery activation is maintained by Admin.') }}
                </p>
                @endif
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
                        <input type="number" class="form-control" name="est_shipping_days"
                            value="{{ $product->est_shipping_days }}" min="1" step="1" placeholder="{{translate('Shipping Days')}}">
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

                @php
                $tax_amount = 0;
                $tax_type = '';
                foreach($tax->product_taxes as $row) {
                if($product->id == $row->product_id) {
                $tax_amount = $row->tax;
                $tax_type = $row->tax_type;
                }
                }
                @endphp

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="number" lang="en" min="0" value="{{ $tax_amount }}" step="0.01"
                            placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control aiz-selectpicker" name="tax_type[]">
                            <option value="amount" @if($tax_type=='amount' ) selected @endif>
                                {{translate('Flat')}}
                            </option>
                            <option value="percent" @if($tax_type=='percent' ) selected @endif>
                                {{translate('Percent')}}
                            </option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="mar-all text-right mb-2">
            <button type="submit" name="button" value="publish"
                class="btn btn-primary">{{ translate('Update Product') }}</button>
        </div>
    </div>
    </div>
</form>

@endsection

@section('script')
<script type="text/javascript">

    $(document).ready(function (){
        show_hide_shipping_div();
    });

    $("[name=shipping_type]").on("change", function (){
        show_hide_shipping_div();
    });

    function show_hide_shipping_div() {
        var shipping_val = $("[name=shipping_type]:checked").val();

        $(".flat_rate_shipping_div").hide();

        if(shipping_val == 'flat_rate'){
            $(".flat_rate_shipping_div").show();
        }
    }


    function add_more_customer_choice_option(i, name){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'{{ route('seller.products.add-more-choice-option') }}',
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
                        <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" multiple>\
                            '+obj+'\
                        </select>\
                    </div>\
                </div>');
                AIZ.plugins.bootstrapSelect('refresh');
           }
       });


    }

    $('input[name="colors_active"]').on('change', function() {
        if(!$('input[name="colors_active"]').is(':checked')){
            $('#colors').prop('disabled', true);
            AIZ.plugins.bootstrapSelect('refresh');
        }
        else{
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

    function delete_row(em){
        $(em).closest('.form-group').remove();
        update_sku();
    }

    function delete_variant(em){
        $(em).closest('.variant').remove();
    }
    update_sku();
    function update_sku(){
        $.ajax({
           type:"POST",
           url:'{{ route('seller.products.sku_combination_edit') }}',
           data:$('#choice_form').serialize(),
           success: function(data){
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

    AIZ.plugins.tagify();


    $(document).ready(function(){
        update_sku();

        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
    });

    $('#choice_attributes').on('change', function() {
        $.each($("#choice_attributes option:selected"), function(j, attribute){
            flag = false;
            $('input[name="choice_no[]"]').each(function(i, choice_no) {
                if($(attribute).val() == $(choice_no).val()){
                    flag = true;
                }
            });
            if(!flag){
                add_more_customer_choice_option($(attribute).val(), $(attribute).text());
            }
        });

        var str = @php echo $product->attributes @endphp;

        $.each(str, function(index, value){
            flag = false;
            $.each($("#choice_attributes option:selected"), function(j, attribute){
                if(value == $(attribute).val()){
                    flag = true;
                }
            });
            if(!flag){
                $('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
            }
        });

        update_sku();
    });


</script>
@endsection



@section('kemetro_script')
<script>


        function get_attribute(){
            var category_id=$("#category_id").val();
            var id=$("#id").val();

            $.ajax({
                    url: "{{ route('products.get.editAttributes') }}",
                    method: "GET",
                    data: {
                        "category_id": category_id,
                        "id": id
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




        function update_sku2() {
            var choiceOptions=$('#choice_options').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('seller.products.sku_combination_edit2') }}",
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
                    url: "{{route('get-to-seller-city-frontend')}}",
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
@endsection
