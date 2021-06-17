@extends('site.app')
@section('title', $category->name)
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page text-category">{{ $category->name }}</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="filters-group">
            <div class="filter-options">
                @foreach($filtro as $key)
                <button class="btn btn-outline-info" data-group="{{$key}}">{{strtoupper($key)}}</button>
                @endforeach
            </div>
        </div><br>
        <div id="code_prod_complex">
            <div class="row" id="grid">
                @forelse($category->products as $product)
                @php
                $porciones = explode(" ", $product->name);
                @endphp
                <div class="col-md-4 picture-item" data-groups='["{{strtolower($porciones[0])}}"]'>
                    <figure class="card card-product">
                        @if ($product->images->count() > 0)
                        <div class="img-wrap padding-y"><img src="{{url('/')}}/{{$product->images->first()->full}}" alt=""></div>
                        @else
                        <div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
                        @endif
                        <figcaption class="info-wrap">
                            <h4 class="title"><a href="#">{{ $product->name }}</a></h4>
                        </figcaption>
                        <div class="bottom-wrap">
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-success float-right"><i class="fa fa-cart-arrow-down"></i> Comprar Ahora</a>
                            @if ($product->sale_price != 0)
                            <div class="price-wrap h5">
                                <span class="price"> {{ config('settings.currency_symbol').$product->sale_price }} </span>
                                <del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del>
                            </div>
                            @else
                            <div class="price-wrap h5">
                                <span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
                            </div>
                            @endif
                        </div>
                    </figure>
                </div>
                @empty
                <p>No hay productos en {{ $category->name }}.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@stop
@push('scripts')
<script src="{{ asset('frontend/js/filter.js') }}" type="text/javascript"></script>
@endpush