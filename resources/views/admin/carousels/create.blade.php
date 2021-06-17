@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
    </div>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="tile">
            <h3 class="tile-title">{{ $subTitle }}</h3>
            <form action="{{ route('admin.carousels.store') }}" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="name">Nombre <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}"/>
                        {{ $errors->first('name') }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Imagen</label>
                        <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" type="file" id="logo" name="logo"/>
                        {{ $errors->first('logo') }}
                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Slider</button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('admin.carousels.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection