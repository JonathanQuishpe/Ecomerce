@extends('site.app')
@section('title', 'Registrarse')
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page">Registrarse</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Formulario de Registro</h4>
                </header>
                <article class="card-body">
                    <form action="{{ route('register') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="first_name">Nombres</label>
                                <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            </div>
                            <div class="col form-group">
                                <label for="last_name">Apellidos</label>
                                <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name" id="last_name" value="{{ old('last_name') }}">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city">Ciudad</label>
                                <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country">Pais</label>
                                <select id="country" class="form-control" name="country">
                                    <option value="Ecuador" selected="">Ecuador</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block"> Registrar </button>
                        </div>
                        <small class="text-muted">Al dar click en el botón 'Registrar', tú confirmas que aceptas nuestros <br> Términos de uso y políticas de privacidad.</small>
                    </form>
                </article>
                <div class="border-top card-body text-center">¿Tienes cuenta? <a href="{{ route('login') }}">Inicia Sesión</a></div>
            </div>
        </div>
    </div>
</section>
@stop