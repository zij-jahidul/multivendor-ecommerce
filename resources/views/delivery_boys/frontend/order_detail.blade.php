@extends('frontend.layouts.user_panel')

@section('panel_content')
<div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Order id')}}: {{ $order->code }}</h1>
        </div>
    </div>
</div>


@php
    $status = $order->orderDetails->first()->delivery_status;
@endphp

<div class="card mt-4">
    <div class="card-header">
        <b class="fs-15">{{ translate('Order Summary') }}</b>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-borderless">
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Order Code')}}:</td>
                        <td>{{ $order->code }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Customer')}}:</td>
                        <td>{{ json_decode($order->shipping_address)->name }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Email')}}:</td>
                        @if ($order->user_id != null)
                            <td>{{ $order->user->email }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Shipping address')}}:</td>
                        <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->postal_code }}, {{ json_decode($order->shipping_address)->country }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <table class="table table-borderless">
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Order date')}}:</td>
                        <td>{{ date('d-m-Y H:i A', $order->date) }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Order status')}}:</td>
                        <td>{{ translate(ucfirst(str_replace('_', ' ', $status))) }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Total order amount')}}:</td>
                        <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Shipping method')}}:</td>
                        <td>{{ translate('Flat shipping rate')}}</td>
                    </tr>
                    <tr>
                        <td class="w-50 fw-600">{{ translate('Payment method')}}:</td>
                        <td>{{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}</td>
                    </tr>
                    @if ($order->tracking_code)
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Tracking code')}}:</td>
                            <td>{{ $order->tracking_code }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="card mt-4">
            <div class="card-header">
                <b class="fs-15">{{ translate('Order Details') }}</b>
            </div>
            <div class="card-body pb-0">
                <table class="table table-borderless table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="30%">{{ translate('Product')}}</th>
                            <th>{{ translate('Variation')}}</th>
                            <th>{{ translate('Quantity')}}</th>
                            <th>{{ translate('Delivery Type')}}</th>
                            <th>{{ translate('Price')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $key => $orderDetail)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    @if ($orderDetail->product != null && $orderDetail->product->auction_product == 0)
                                        <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->getTranslation('name') }}</a>
                                    @elseif($orderDetail->product != null && $orderDetail->product->auction_product == 1)
                                        <a href="{{ route('auction-product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->getTranslation('name') }}</a>
                                    @else
                                        <strong>{{  translate('Product Unavailable') }}</strong>
                                    @endif
                                </td>
                                <td>
                                    {{ $orderDetail->variation }}
                                </td>
                                <td>
                                    {{ $orderDetail->quantity }}
                                </td>
                                <td>
                                    @if ($order->shipping_type != null && $order->shipping_type == 'home_delivery')
                                        {{  translate('Home Delivery') }}
                                    @elseif ($order->shipping_type == 'pickup_point')
                                        @if ($order->pickup_point != null)
                                            {{ $order->pickup_point->name }} ({{  translate('Pickip Point') }})
                                        @endif
                                    @endif
                                </td>
                                <td>{{ single_price($orderDetail->price) }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card mt-4">
            <div class="card-header">
                <b class="fs-15">{{ translate('Order Ammount') }}</b>
            </div>
            <div class="card-body pb-0">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Subtotal')}}</td>
                            <td class="text-right">
                                <span class="strong-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping')}}</td>
                            <td class="text-right">
                                <span class="text-italic">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Tax')}}</td>
                            <td class="text-right">
                                <span class="text-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Coupon')}}</td>
                            <td class="text-right">
                                <span class="text-italic">{{ single_price($order->coupon_discount) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Total')}}</td>
                            <td class="text-right">
                                <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if ($order->manual_payment && $order->manual_payment_data == null)
            <button onclick="show_make_payment_modal({{ $order->id }})" class="btn btn-block btn-primary">{{ translate('Make Payment')}}</button>
        @endif
    </div>
</div>

@endsection

@section('modal')

<!-- Product Review Modal -->
<div class="modal fade" id="product-review-modal">
    <div class="modal-dialog">
        <div class="modal-content" id="product-review-modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div id="payment_modal_body">

            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script type="text/javascript">
    function show_make_payment_modal(order_id){
        $.post('{{ route('checkout.make_payment') }}', {_token:'{{ csrf_token() }}', order_id : order_id}, function(data){
            $('#payment_modal_body').html(data);
            $('#payment_modal').modal('show');
            $('input[name=order_id]').val(order_id);
        });
    }

    function product_review(product_id){
          $.post('{{ route('product_review_modal') }}',{_token:'{{ @csrf_token() }}', product_id:product_id}, function(data){
              $('#product-review-modal-content').html(data);
              $('#product-review-modal').modal('show', {backdrop: 'static'});
              AIZ.extra.inputRating();
          });
      }
</script>
@endsection
