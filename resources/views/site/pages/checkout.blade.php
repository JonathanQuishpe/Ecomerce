@extends('site.app')
@section('title', 'Proceso')
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page">Proceso de Compra</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif
            </div>
        </div>
        <form action="{{ route('checkout.place.order') }}" method="POST" role="form" id="addToCart">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <header class="card-header">
                            <h4 class="card-title mt-2">Datos Factura</h4>
                        </header>
                        <article class="card-body">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Nombre</label>
                                    <input 
                                        type="text" 
                                        class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" 
                                        name="first_name"
                                        value="{{ old('first_name') }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> 
                                        <span>{{ $errors->first('first_name') }}</span>
                                    </div>
                                </div>
                                <div class="col form-group">
                                    <label>Apellido</label>
                                    <input 
                                        type="text" 
                                        class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" 
                                        name="last_name"
                                        value="{{ old('last_name') }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> 
                                        <span>{{ $errors->first('last_name') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dirección</label>
                                <input 
                                    type="text" 
                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" 
                                    name="address"
                                    value="{{ old('address') }}">
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> 
                                    <span>{{ $errors->first('address') }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Ciudad</label>
                                    <select class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                            name="city"
                                            id="city">
                                        <option value="Quito" selected="">Quito</option>
                                        <option value="Galapagos">Galápagos</option>
                                        <option value="Otra">Otra</option>
                                    </select>
                                    <!--<input 
                                    type="text" 
                                    class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" 
                                    name="city"
                                    value="{{ old('city') }}">-->
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> 
                                        <span>{{ $errors->first('city') }}</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pais</label>
                                    <input 
                                        type="text" 
                                        class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" 
                                        name="country"
                                        value="Ecuador" readonly="">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> 
                                        <span>{{ $errors->first('country') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label>Código Postal</label>
                                    <input 
                                        type="text" 
                                        class="form-control {{ $errors->has('post_code') ? 'is-invalid' : '' }}" 
                                        name="post_code"
                                        value="{{ old('post_code') }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> 
                                        <span>{{ $errors->first('post_code') }}</span>
                                    </div>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Teléfono</label>
                                    <input 
                                        type="text" 
                                        class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" 
                                        name="phone_number"
                                        value="{{ old('phone_number') }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> 
                                        <span>{{ $errors->first('phone_number') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled>
                                <small class="form-text text-muted">Nunca compartas tu correo eléctronico con nadie.</small>
                            </div>
                            <div class="form-group">
                                <label>Notas al pedido</label>
                                <textarea class="form-control" name="notes" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terminos" id="terminos" value="1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Acepto Términos y Condiciones. <a target="_blank" href="{{url('/')}}/documents/condiciones.pdf">Ver</a>
                                    </label>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <header class="card-header">
                                    <h4 class="card-title mt-2">Tu Orden</h4>
                                </header>
                                <article class="card-body">
                                    <dl class="dlist-align">
                                        <dt>SubTotal: </dt>
                                        <dd class="text-right h5 b"> {{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }} </dd>
                                        <input type="hidden" name="subtotal" id="subtotal" value="{{ \Cart::getSubTotal() }}">
                                    </dl>
                                    <dl class="dlist-align">
                                        <dt>Envio: </dt>
                                        <dd class="text-right h5 b costo">$ 2.00</dd>
                                        <input type="hidden" name="costo_envio" id="costo_envio" value="2">
                                    </dl>
                                    <dl class="dlist-align">
                                        <dt>Precio Total: </dt>
                                        <dd class="text-right h5 b precio_total"></dd>
                                    </dl>
                                </article>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <header class="card-header">
                                    <h4 class="card-title mt-2">Formas de Pago</h4>
                                </header>
                                <article class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="forma_pago" id="forma_pago" value="DPT">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Deposito o Transferencia bancaria
                                        </label><br>
                                        <div class="cuenta">
                                            <strong>Cuenta bancaria</strong>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="forma_pago" id="forma_pago" value="PEPC">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Pago en efectivo en la puerta de tu casa
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="forma_pago" id="forma_pago" value="PTPC">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Pago con Tarjeta de Crédito en la puerta de tu casa (Sólo Quito)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="forma_pago" id="forma_pago" value="PAYPAL">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Pagar con
                                            <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" border="0" alt="PayPal Logo">
                                        </label>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="subscribe btn btn-success btn-lg btn-block">Procesar Orden</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@stop
@push('scripts')
<script>
    $(document).ready(function () {
        var subtotal = $('#subtotal').val();
        var envio = $('#costo_envio').val();
        var total = parseFloat(subtotal) + parseFloat(envio);
        $('.precio_total').text('$' + total.toFixed(2));
        $('.cuenta').hide();
        $('#addToCart').submit(function (e) {
            var val = $('input:radio[name=forma_pago]:checked').val();
            var terminos = $('input:checkbox[name=terminos]:checked').val();

            if (terminos == null) {
                e.preventDefault();
                swal('Debe aceptar los términos y condiciones.');
                return
            }
            if (val == null) {
                e.preventDefault();
                swal('Elija una forma de pago.');
                return
            }
            $('body').loading({
                message: 'Procesando Pago ...',
                theme: 'dark'
            });
        });
        $("input:radio[name=forma_pago]").click(function () {
            if ($(this).val() === 'DPT') {
                $(".cuenta").show("slow");
            } else {
                $(".cuenta").hide("slow");
            }
        });
        $("#city").change(function () {
            var ciudad = $(this).val();
            var subtotal = $('#subtotal').val();
            var envio = 0.00;
            if (ciudad === 'Quito') {
                $('#costo_envio').val(2);
                $('.costo').text('$ 2.00');
                envio = 2;
            } else if (ciudad === 'Galapagos') {
                $('#costo_envio').val(8);
                $('.costo').text('$ 8.00');
                envio = 8;
            } else {
                $('#costo_envio').val(4);
                $('.costo').text('$ 4.00');
                envio = 4;
            }
            var total = parseFloat(subtotal) + parseFloat(envio);
            $('.precio_total').text('$' + total.toFixed(2));
        });
    });
</script>
@endpush