@extends('seller.layouts.app')
@section('panel_content')

    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Purchase Package List') }}</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6">{{ translate('All Purchase Package') }}</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="30%">{{ translate('Package')}}</th>
                        <th data-breakpoints="md">{{ translate('Package Price')}}</th>
                        <th data-breakpoints="md">{{ translate('Payment Type')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($seller_packages_payment as $key => $payment)
                        <tr>
                            <td>{{ ($key+1) + ($seller_packages_payment->currentPage() - 1) * $seller_packages_payment->perPage() }}</td>
                            <td>{{ $payment->seller_package->name }}</td>
                            <td>{{ $payment->seller_package->amount }}</td>
                            <td>
                                @if($payment->offline_payment == 1)
                                    {{ translate('Offline Payment') }}
                                @else
                                    {{ translate('Online Payment') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $seller_packages_payment->links() }}
          	</div>
        </div>
    </div>

@endsection
