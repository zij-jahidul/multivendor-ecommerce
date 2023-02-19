@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Seller Packages')}}</h1>
		</div>
        @can('add_seller_package')
            <div class="col-md-6 text-md-right">
                <a href="{{ route('seller_packages.create') }}" class="btn btn-circle btn-info">
                    <span>{{translate('Add New Package')}}</span>
                </a>
            </div>
        @endcan
	</div>
</div>


<div class="row">
    @foreach ($seller_packages as $key => $seller_package)
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body text-center">
					<img alt="{{ translate('Package Logo')}}" src="{{ uploaded_asset($seller_package->logo) }}" class="mw-100 mx-auto mb-4" height="150px">
					<p class="mb-3 h6 fw-600">{{ $seller_package->getTranslation('name') }}</p>
                    <p class="h4">{{single_price($seller_package->amount)}}</p>
                    <p class="fs-15">{{translate('Product Upload Limit') }}:
                        <b class="text-bold">{{$seller_package->product_upload_limit}}</b>
                    </p>
					<p class="fs-15">{{translate('Package Duration') }}:
                        <b class="text-bold">{{$seller_package->duration}} {{translate('days')}}</b>
                    </p>
                    <div class="mar-top">
                        @can('edit_seller_package')
						    <a href="{{route('seller_packages.edit', ['id'=>$seller_package->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" class="btn btn-sm btn-info">{{translate('Edit')}}</a>
                        @endcan
                        @can('delete_seller_package')
                            <a href="#" data-href="{{route('seller_packages.destroy', $seller_package->id)}}" class="btn btn-sm btn-danger confirm-delete">{{translate('Delete')}}</a>
                        @endcan                        
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
