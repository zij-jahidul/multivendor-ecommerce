@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h5">{{ translate('Edit Digital Product') }}</h5>
    </div>
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <form class="form form-horizontal mar-top" action="{{ route('digitalproducts.update', $product->id) }}"
                method="POST" enctype="multipart/form-data" id="choice_form">
                <input name="_method" type="hidden" value="PATCH">
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="lang" value="{{ $lang }}">
                @csrf
                <div class="card">
                    <div class="card-body p-0">
                       <!-- <ul class="nav nav-tabs nav-fill border-light">
                            @foreach (\App\Models\Language::all() as $key => $language)
                                <li class="nav-item">
                                    <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                        href="{{ route('digitalproducts.edit', ['id' => $product->id, 'lang' => $language->code]) }}">
                                        <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                            height="11" class="mr-1">
                                        <span>{{ $language->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul> -->
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('General') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Product Name') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="name"
                                    placeholder="{{ translate('Product Name') }}"
                                    value="{{ $product->getTranslation('name', $lang) }}" required>
                            </div>
                        </div>
{{--                        <div class="form-group row" id="category">--}}
{{--                            <label class="col-lg-3 col-from-label">{{translate('Category')}}</label>--}}
{{--                            <div class="col-lg-8">--}}
{{--                                <select class="form-control aiz-selectpicker" name="category_ids[]" id="category_id"  data-live-search="true" required multiple onchange="get_attribute()">--}}
{{--                                    @foreach($productCategories as $productCategory)--}}
{{--                                        <option value="{{ $productCategory->category_id }}" selected>{{ translate($productCategory->name) }}</option>--}}
{{--                                    @endforeach--}}
{{--                                    @foreach ($categories as $category)--}}
{{--                                        <option value="{{ $category->id }}">{{ translate($category->name) }}</option>--}}
{{--                                        @foreach ($category->childrenCategories as $childCategory)--}}
{{--                                            @include('categories.child_category', ['child_category' => $childCategory])--}}
{{--                                        @endforeach--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row" id="category">
                            <label class="col-lg-2 col-from-label">{{ translate('Category') }}</label>
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
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Product File') }}</label>
                            <div class="col-lg-8">
                                <div class="input-group" data-toggle="aizuploader" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="file" class="selected-files"
                                        value="{{ $product->file_name }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Tags') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control aiz-tag-input" name="tags[]" id="tags"
                                    value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}">
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
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>
                            </div>
                            <div class="col-lg-8">
                                <select name="choice_attributes[]" id="choice_attributes" data-selected-text-format="count" data-live-search="true" class="form-control aiz-selectpicker" multiple data-placeholder="{{ translate('Choose Attributes') }}">
                              <!--      @foreach (\App\Models\Attribute::where('verify', 1)->get() as $key => $attribute)
                                        <option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->getTranslation('name') }}</option>
                                    @endforeach -->
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>
                            <br>
                        </div>

                        <div class="customer_choice_options" id="customer_choice_options">
                            @foreach (json_decode($product->choice_options) as $key => $choice_option)
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
                                        <input type="text" class="form-control" name="choice[]" value="{{ translate(optional(\App\Models\Attribute::find($choice_option->attribute_id))->name) }}" placeholder="{{ translate('Choice Title') }}" disabled>
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

{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h5 class="mb-0 h6">{{translate('Product Variation')}}</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}

{{--                        <div class="form-group row gutters-5">--}}
{{--                            <div class="col-md-3">--}}
{{--                                <input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-8">--}}
{{--                                <select name="choice_attributes[]" id="choice_attributes" class="form-control aiz-selectpicker" data-selected-text-format="count" data-live-search="true" multiple data-placeholder="{{ translate('Choose Attributes') }}">--}}
{{--                                <!-- @foreach (\App\Models\Attribute::where('verify', 1)->get() as $key => $attribute)--}}
{{--                                    <option value="{{ $attribute->id }}">{{ translate($attribute->name) }}</option>--}}
{{--                                    @endforeach -->--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>--}}
{{--                            <br>--}}
{{--                        </div>--}}

{{--                        <div class="customer_choice_options" id="customer_choice_options">--}}

{{--                        </div>--}}



{{--                    </div>--}}
{{--                </div>--}}


                <div class="card">
                    <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Images') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                                for="signinSrEmail">{{ translate('Main Images') }}</label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="photos" value="{{ $product->photos }}"
                                        class="selected-files" required>
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="signinSrEmail">{{ translate('Thumbnail Image') }}
                                <small>(290x300)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="thumbnail_img" value="{{ $product->thumbnail_img }}"
                                        class="selected-files" required>
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Meta Tags') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Meta Title') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ $product->meta_title }}" placeholder="{{ translate('Meta Title') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Description') }}</label>
                            <div class="col-lg-8">
                                <textarea name="meta_description" rows="8" class="form-control" required>{{ $product->meta_description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                                for="signinSrEmail">{{ translate('Meta Image') }}</label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image"
                                    data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="meta_img" value="{{ $product->meta_img }}"
                                        class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">{{ translate('Slug') }}</label>
                            <div class="col-lg-8">
                                <input type="text" placeholder="{{ translate('Slug') }}" id="slug"
                                    name="slug" value="{{ $product->slug }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Price') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Unit price') }}</label>
                            <div class="col-lg-8">
                                <input type="text" placeholder="{{ translate('Unit price') }}" name="unit_price"
                                    class="form-control" value="{{ $product->unit_price }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Purchase price') }}</label>
                            <div class="col-lg-8">
                                <input type="number" lang="en" min="0" step="0.01"
                                    placeholder="{{ translate('Purchase price') }}" name="purchase_price"
                                    class="form-control" value="{{ $product->purchase_price }}" required>
                            </div>
                        </div>

                        @foreach (\App\Models\Tax::where('tax_status', 1)->get() as $tax)
                            @php
                                $tax_amount = 0;
                                $tax_type = '';
                                foreach ($tax->product_taxes as $row) {
                                    if ($product->id == $row->product_id) {
                                        $tax_amount = $row->tax;
                                        $tax_type = $row->tax_type;
                                    }
                                }
                            @endphp
                            <div class="form-group row">
                                <label class="col-lg-2 col-from-label">
                                    {{$tax->name}}
                                </label>
                                <div class="col-lg-6">
                                    <input type="hidden" value="{{$tax->id}}" name="tax_id[]">
                                    <input type="number" lang="en" min="0" step="0.01"
                                        placeholder="{{ translate('tax') }}" name="tax[]" class="form-control"
                                        value="{{ $tax_amount }}" required>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control aiz-selectpicker" name="tax_type[]" required>
                                        <option value="amount" @if($tax_type == 'amount') selected @endif>
                                            {{translate('Flat')}}
                                        </option>
                                        <option value="percent" @if($tax_type == 'percent') selected @endif>
                                            {{translate('Percent')}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        @endforeach

                        @php
                            $start_date = $product->discount_start_date ? date('d-m-Y H:i:s', $product->discount_start_date) : null;
                            $end_date   = $product->discount_end_date ? date('d-m-Y H:i:s', $product->discount_end_date) : null;
                        @endphp

                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label"
                                for="start_date">{{ translate('Discount Date Range') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control aiz-date-range"
                                    value="{{ $start_date && $end_date ? $start_date . ' to ' . $end_date : '' }}" name="date_range"
                                    placeholder="{{ translate('Select Date') }}" data-time-picker="true"
                                    data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Discount') }}</label>
                            <div class="col-lg-6">
                                <input type="number" lang="en" min="0" step="0.01"
                                    placeholder="{{ translate('Discount') }}" name="discount" class="form-control"
                                    value="{{ $product->discount }}" required>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-control aiz-selectpicker" name="discount_type" required>
                                    <option value="amount" <?php if ($product->discount_type == 'amount') {
                                        echo 'selected';
                                    } ?>>{{ translate('Flat') }}</option>
                                    <option value="percent" <?php if ($product->discount_type == 'percent') {
                                        echo 'selected';
                                    } ?>>{{ translate('Percent') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Description') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Description') }}</label>
                            <div class="col-lg-9">
                                <textarea class="aiz-text-editor" name="description">{{ $product->getTranslation('description', $lang) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-right">
                    <button type="submit" name="button"
                        class="btn btn-primary">{{ translate('Update Product') }}</button>
                </div>
        </div>
        </form>
    </div>
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
                url:'{{ route('products.add-more-choice-option') }}',
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

        function update_sku(){
            $.ajax({
                type:"POST",
                url:'{{ route('products.sku_combination_edit') }}',
                data:$('#choice_form').serialize(),
                success: function(data){
                    $('#sku_combination').html(data);
                    setTimeout(() => {
                        AIZ.uploader.previewGenerate();
                    }, "500");
                    AIZ.plugins.fooTable();
                    if (data.length > 1) {
                        $('#show-hide-div').hide();
                    }
                    else {
                        $('#show-hide-div').show();
                    }
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


@section('script')

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

        function add_more_customer_choice_option(i, name){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:'{{ route('products.add-more-choice-option') }}',
                data:{
                    attribute_id: i
                },
                success: function(data) {
                    //alert(JSON.stringify(data));
                    var obj = JSON.parse(data);
                    $('#customer_choice_options').append('\
                <div class="form-group row">\
                    <div class="col-md-3">\
                        <input type="hidden" name="choice_no[]" value="'+i+'">\
                        <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="{{ translate('Choice Title') }}" readonly>\
                    </div>\
                    <div class="col-md-8">\
                        <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" id="choice_options" multiple>\
                            '+obj+'\
                        </select>\
                    </div>\
                </div>');
                    AIZ.plugins.bootstrapSelect('refresh');
                },
                error: function(response) {
                    //alert(JSON.stringify(response));
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

        function update_sku(){
            $.ajax({
                type:"POST",
                url:'{{ route('products.sku_combination') }}',
                data:$('#choice_form').serialize(),
                success: function(data) {
                    alert(JSON.stringify(data));
                    $('#sku_combination').html(data);
                    AIZ.uploader.previewGenerate();
                    AIZ.plugins.fooTable();
                    if (data.length > 1) {
                        $('#show-hide-div').hide();
                    }
                    else {
                        $('#show-hide-div').show();
                    }
                },
                error: function(response){
                    alert(JSON.stringify(response));
                }
            });
        }

        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function(){
                add_more_customer_choice_option($(this).val(), $(this).text());
            });

            update_sku();
        });
    </script>

@endsection

@section('kemetro_script')
    <script>
        function get_attribute(){
            var category_id=$("#category_id").val();
            $.ajax({
                url: "{{ route('products.get.attributes') }}",
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

        function saveCategoryProducts(){
            var category_id=$("#category_id").val();
            $.ajax({
                url: "{{ route('products.categoryProductSave') }}",
                method: "GET",
                data: {
                    "category_id": category_id
                },
                success: function(result) {
                    //alert(JSON.stringify(result));

                },
                error: function(response) {
                    //`alert(JSON.stringify(response));
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
@endsection
