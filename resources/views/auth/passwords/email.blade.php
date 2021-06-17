@extends('site.app')
@section('title', 'Reestablecer')
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page">Olvidaste tu contraseña</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Reestablecer contraseña</h4>
                </header>
                <article class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block"> Reestablecer </button>
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </div>
</section>
@stop