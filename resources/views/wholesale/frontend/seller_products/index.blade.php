@extends('seller.layouts.app')
@section('panel_content')

<div class="row gutters-10 justify-content-center">
    @if (addon_is_activated('seller_subscription'))
        <div class="col-md-4 mx-auto mb-3" >
            <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
              <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                  <i class="las la-upload la-2x text-white"></i>
              </span>
              <div class="px-3 pt-3 pb-3">
                <div class="h4 fw-700 text-center">{{ optional(Auth::user()->shop->seller_package)->product_upload_limit - Auth::user()->products()->count() }}</div>
                  <div class="opacity-50 text-center">{{  translate('Remaining Uploads') }}</div>
              </div>
            </div>
        </div>
    @endif

    <div class="col-md-4 mx-auto mb-3" >
        <a href="{{ route('wholesale_product_create.seller')}}">
          <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition">
              <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                  <i class="las la-plus la-3x text-white"></i>
              </span>
              <div class="fs-18 text-primary">{{ translate('Add New Wholesale Product') }}</div>
          </div>
        </a>
    </div>

    @if (addon_is_activated('seller_subscription'))
    @php
        $seller_package = \App\Models\SellerPackage::find(Auth::user()->shop->seller_package_id);
    @endphp
    <div class="col-md-4">
        <a href="{{ route('seller.seller_packages_list') }}" class="text-center bg-white shadow-sm hov-shadow-lg text-center d-block p-3 rounded">
            @if($seller_package != null)
                <img src="{{ uploaded_asset($seller_package->logo) }}" height="44" class="mw-100 mx-auto">
                <span class="d-block sub-title mb-2">{{ translate('Current Package')}}: {{ translate($seller_package->name) }}</span>
            @else
                <i class="la la-frown-o mb-2 la-3x"></i>
                <div class="d-block sub-title mb-2">{{ translate('No Package Found')}}</div>
            @endif
            <div class="btn btn-outline-primary py-1">{{ translate('Upgrade Package')}}</div>
        </a>
    </div>
    @endif

</div>

<div class="card">
    <form class="" id="sort_products" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6">{{ translate('All Wholesale Product') }}</h5>
            </div>
            <div class="col-md-2 ml-auto">
                <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="type" id="type" onchange="sort_products()">
                    <option value="">{{ translate('Sort By') }}</option>
                    <option value="rating,desc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{translate('Rating (High > Low)')}}</option>
                    <option value="rating,asc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{translate('Rating (Low > High)')}}</option>
                    <option value="num_of_sale,desc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{translate('Num of Sale (High > Low)')}}</option>
                    <option value="num_of_sale,asc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{translate('Num of Sale (Low > High)')}}</option>
                    <option value="unit_price,desc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{translate('Base Price (High > Low)')}}</option>
                    <option value="unit_price,asc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{translate('Base Price (Low > High)')}}</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type & Enter') }}">
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th data-breakpoints="lg">#</th>
                        <th>{{translate('Name')}}</th>
                        <th data-breakpoints="sm">{{translate('Info')}}</th>
                        <th data-breakpoints="md">{{translate('Total Stock')}}</th>
                        @if(get_setting('product_approve_by_admin'))
                            <th data-breakpoints="lg">{{translate('Approved')}}</th>
                        @endif
                        <th data-breakpoints="lg">{{translate('Published')}}</th>
                        <th data-breakpoints="lg">{{translate('Featured')}}</th>
                        <th data-breakpoints="sm" class="text-right">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                    <tr>
                        <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                        <td>
                            <div class="row gutters-5 w-200px w-md-300px mw-100">
                                <div class="col-auto">
                                    <img src="{{ uploaded_asset($product->thumbnail_img)}}" alt="Image" class="size-50px img-fit">
                                </div>
                                <div class="col">
                                    <span class="text-muted text-truncate-2">{{ translate($product->name) }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{translate('Num of Sale')}}:</strong> {{ $product->num_of_sale }} {{translate('times')}} </br>
                            <strong>{{translate('Base Price')}}:</strong> {{ single_price($product->unit_price) }} </br>
                            <strong>{{translate('Rating')}}:</strong> {{ $product->rating }} </br>
                        </td>
                        <td>
                            @php
                                $qty = 0;
                                if($product->variant_product) {
                                    foreach ($product->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                        echo $stock->variant.' - '.$stock->qty.'<br>';
                                    }
                                }
                                else {
                                    $qty = optional($product->stocks->first())->qty;
                                    echo $qty;
                                }
                            @endphp
                            @if($qty <= $product->low_stock_quantity)
                                <span class="badge badge-inline badge-danger">Low</span>
                            @endif
                        </td>
                        @if(get_setting('product_approve_by_admin') == 1)
                            <td>
                                @if ($product->approved == 1)
                                    <span class="badge badge-inline badge-success">{{ translate('Approved')}}</span>
                                @else
                                    <span class="badge badge-inline badge-info">{{ translate('Pending')}}</span>
                                @endif
                            </td>
                        @endif
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->published == 1) echo "checked"; ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->seller_featured == 1) echo "checked"; ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-success btn-icon btn-circle btn-sm"  href="{{ route('product', $product->slug) }}" target="_blank" title="{{ translate('View') }}">
                                <i class="las la-eye"></i>
                            </a>
                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{route('wholesale_product_edit.seller', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('wholesale_product_destroy.seller', $product->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </form>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }


        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('seller.products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function sort_products(el){
            $('#sort_products').submit();
        }

    </script>
@endsection
