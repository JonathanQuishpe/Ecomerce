@extends('site.app')
@section('title', $product->name)
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page">{{ $product->name }}</h2>
    </div>
</section>
<section class="section-content bg padding-y border-top" id="site">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button class="close" type="button" data-dismiss="alert">×</button>
                    <strong>Satisfactorio!</strong> {{ Session::get('message') }}
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row no-gutters">
                        <aside class="col-sm-5 border-right">
                            <article class="gallery-wrap">
                                @if ($product->images->count() > 0)
                                <div class="img-big-wrap">
                                    <div class="padding-y">
                                        <a href="{{url('/')}}/{{ $product->images->first()->full }}" data-fancybox="" id="main-img-href">
                                            <img src="{{url('/')}}/{{ $product->images->first()->full }}" alt="" id="main-img">
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="img-big-wrap">
                                    <div>
                                        <a href="https://via.placeholder.com/176" data-fancybox=""><img src="https://via.placeholder.com/176"></a>
                                    </div>
                                </div>
                                @endif
                                @if ($product->images->count() > 0)
                                <div class="img-small-wrap">
                                    @foreach($product->images as $image)
                                    <div class="item-gallery">
                                        <img src="{{url('/')}}/{{ $image->full }}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </article>
                        </aside>
                        <aside class="col-sm-7">
                            <article class="p-5">
                                <h3 class="title mb-3">{{ $product->name }}</h3>
                                <dl class="row">
                                    <dt class="col-sm-3">Código</dt>
                                    <dd class="col-sm-9">{{ $product->sku }}</dd>
                                    <!--<dt class="col-sm-3">Weight</dt>
                                    <dd class="col-sm-9">{{ $product->weight }}</dd>-->
                                </dl>
                                <div class="mb-3">
                                    @if ($product->sale_price > 0)
                                    <var class="price h3 text-danger">
                                        <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->sale_price }}</span>
                                        <del class="price-old"> {{ config('settings.currency_symbol') }}{{ $product->price }}</del>
                                    </var>
                                    @else
                                    <var class="price h3 text-success">
                                        <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->price }}</span>
                                    </var>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <span class="badge badge-danger">6% de descuento por pago en efectivo.</span>
                                </div>
                                <hr>
                                <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <dl class="dlist-inline">
                                                @foreach($attributes as $attribute)
                                                @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                                @if ($attributeCheck)
                                                <dt>{{ $attribute->name }}: </dt>
                                                <dd>
                                                    <select class="form-control form-control-sm option" style="width:180px;" name="{{ strtolower($attribute->name ) }}">
                                                        <option data-price="0" value="0"> Selecciona {{ $attribute->name }}</option>
                                                        @foreach($product->attributes as $attributeValue)
                                                        @if ($attributeValue->attribute_id == $attribute->id)
                                                        <option
                                                            data-price="{{ $attributeValue->price }}"
                                                            value="{{ $attributeValue->value }}"> {{ ucwords($attributeValue->value) }}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </dd>
                                                @endif
                                                @endforeach
                                            </dl>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <dl class="dlist-inline">
                                                <dt>Cantidad: </dt>
                                                <dd>
                                                    <input class="form-control" type="number" min="1" value="1" max="{{ $product->quantity }}" name="qty" style="width:70px;">
                                                    <input type="hidden" name="productId" value="{{ $product->id }}">
                                                    <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                    <a href="{{ route('home') }}" class="btn btn-info"><i class="fas fa-plus-square"></i> Seguir Comprando</a>
                                    <a href="{{ route('checkout.cart') }}" class="btn btn-danger"><i class="fas fa-archive"></i> Finalizar Compra</a>
                                </form>
                            </article>
                        </aside>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <article class="card mt-4">
                    <div class="card-body">
                        {{ $product->description }}
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@stop
@push('scripts')
<script>
    $(document).ready(function () {
        $('#addToCart').submit(function (e) {
            var send = true;
            $(".option").each(function () {
                if ($(this).val() == 0) {
                    send = false;
                }
            });
            if (!send) {
                e.preventDefault();
                swal('Por favor eliga todas las opciones');
            }
        });
        $('.option').change(function () {
            $('#productPrice').html("{{ $product->sale_price != '' ? $product->sale_price : $product->price }}");
            let extraPrice = $(this).find(':selected').data('price');
            let price = parseFloat($('#productPrice').html());
            let finalPrice = (Number(extraPrice) + price).toFixed(2);
            $('#finalPrice').val(finalPrice);
            $('#productPrice').html(finalPrice);
        });

        //cambiar imagen de galeria
        $(".gallery-wrap .img-small-wrap .item-gallery img ").hover(function () {
            $('#main-img').attr('src', $(this).attr('src').replace('', ''));
            $('#main-img-href').attr('href', $(this).attr('src').replace('', ''));
        });
    });
</script>
@endpush