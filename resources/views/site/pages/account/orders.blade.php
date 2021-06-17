@extends('site.app')
@section('title', 'Ordenes')
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page">Mis Ordenes</h2>
    </div>
</section>
<section class="section-content bg padding-y border-top">
    <div class="container">
        <div class="row">
        </div>
        <div class="row table-responsive">
            <main class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Orden No.</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Total</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->order_number }}</th>
                            <td>{{ $order->first_name }}</td>
                            <td>{{ $order->last_name }}</td>
                            <td>{{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}</td>
                            <td>{{ $order->item_count }}</td>
                            <td><span class="badge badge-success">{{ strtoupper($order->status) }}</span></td>
                        </tr>
                        @empty
                    <div class="col-sm-12">
                        <p class="alert alert-warning">No tiene ninguna orden.</p>
                    </div>
                    @endforelse
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</section>
@stop