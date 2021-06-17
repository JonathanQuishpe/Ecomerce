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
            <form action="{{ route('admin.carousels.update') }}" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="name">Nombre <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $carousel->name) }}"/>
                        <input type="hidden" name="id" value="{{ $carousel->id }}">
                        {{ $errors->first('name') }}
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="status"
                                       name="status"
                                       {{ $carousel->status == 1 ? 'checked' : '' }}
                                />Mostrar
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            @if ($carousel->logo != null)
                            <div class="col-md-2">
                                <figure class="mt-2" style="width: 80px; height: auto;">
                                    <img src="{{url('/')}}/{{$carousel->logo}}" id="brandLogo" class="img-fluid" alt="img">
                                </figure>
                            </div>
                            @endif
                            <div class="col-md-10">
                                <label class="control-label">Imagen</label>
                                <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" type="file" id="logo" name="logo"/>
                                {{ $errors->first('logo') }}
                            </div>
                        </div>
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