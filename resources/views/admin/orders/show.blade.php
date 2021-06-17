@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-bar-chart"></i> {{ $pageTitle }}</h1>
        <p>{{ $subTitle }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <section class="invoice">
                <div class="row mb-4">
                    <div class="col-6">
                        <h2 class="page-header"><i class="fa fa-globe"></i> {{ $order->order_number }}</h2>
                    </div>
                    <div class="col-6">
                        <h5 class="text-right">Fecha: {{ $order->created_at->toFormattedDateString() }}</h5>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-4">Ordenado Por
                        <address><strong>{{ $order->user->fullName }}</strong><br>Email: {{ $order->user->email }}</address>
                    </div>
                    <div class="col-4">Enviar a
                        <address><strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>{{ $order->address }}<br>{{ $order->city }}, {{ $order->country }} {{ $order->post_code }}<br>{{ $order->phone_number }}<br></address>
                    </div>
                    <div class="col-4">
                        <b>Order ID:</b> {{ $order->order_number }}<br>
                        <b>Monto:</b> {{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}<br>
                        <b>Método Pago:</b> {{ $order->payment_method == null ? $order->name_method  : $order->payment_method }}<br>
                        <b>Estado Pago:</b> {{ $order->payment_status == 1 ? 'Completado' : 'No Completado' }}<br>
                        <b>Estado Orden:</b> {{ $order->status }}<br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <!--<th>Qty</th>-->
                                    <th>Producto</th>
                                    <!--<th>SKU #</th>-->
                                    <th>Cantidad</th>
                                    <th>Talla</th>
                                    <th>Color</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <!--<td>{{ $item->id }}</td>-->
                                    <td>{{ $item->product->name }}</td>
                                    <!--<td>{{ $item->product->sku }}</td>-->
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->color }}</td>
                                    <td>{{ config('settings.currency_symbol') }}{{ round($item->price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection