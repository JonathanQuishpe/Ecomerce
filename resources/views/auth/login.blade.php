@extends('site.app')
@section('title', 'Login')
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page">Iniciar Sesión</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Datos de Usuario</h4>
                </header>
                <article class="card-body">
                    <form action="{{ route('login') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('email')}}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('password')}}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                        </div>
                    </form>
                </article>
                <div class="border-top card-body text-center">
                    ¿No tienes cuenta? <a href="{{ route('register') }}">Registrate</a><br>
                    ¿Olvidaste tu contraseña? <a href="{{ route('password.request') }}">Reestrablecer</a>
                </div>
            </div>
        </div>
    </div>
</section>
@stop