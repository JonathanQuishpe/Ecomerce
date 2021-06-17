@extends('site.app')
@section('title', 'Orden Completada')
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page">Orden Completada</h2>
    </div>
</section>
<section class="section-content bg padding-y border-top">
    <div class="container">
        <div class="row">
            <main class="col-sm-12">
                <p class="alert alert-success">Su pedido se realizó con exito. Tú número de orden es : {{ $order->order_number }}.</p></main>
        </div>
    </div>
</section>
@stop