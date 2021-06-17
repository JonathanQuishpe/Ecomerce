@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-cogs"></i> {{ $pageTitle }}</h1>
    </div>
</div>
@include('admin.partials.flash')
<div class="row user">
    <div class="col-md-3">
        <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
                <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div class="tile">
                    <form action="{{ route('admin.attributes.store') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <h3 class="tile-title">Información Atributos</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="code">Código</label>
                                <input
                                    class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                    type="text"
                                    placeholder="Ingrese código del atributo"
                                    id="code"
                                    name="code"
                                    value="{{ old('code') }}"
                                    />
                                {{ $errors->first('code') }}
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="name">Nombre</label>
                                <input
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    type="text"
                                    placeholder="Ingrese nombre del atributo"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    />
                                {{ $errors->first('name') }}
                            </div>
                            <input type="hidden" name="frontend_type" id="frontend_type" value="select">
                            <!--<div class="form-group">
                                <label class="control-label" for="frontend_type">Frontend Tipo</label>
                                @php $types = ['select' => 'Select Box', 'radio' => 'Radio Button', 'text' => 'Text Field', 'text_area' => 'Text Area']; @endphp
                                <select name="frontend_type" id="frontend_type" class="form-control {{ $errors->has('frontend_type') ? 'is-invalid' : '' }}">
                                    @foreach($types as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                {{ $errors->first('frontend_type') }}
                            </div>-->
                            <!--<div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="is_filterable" name="is_filterable"/>Filtrable
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="is_required" name="is_required"/>Requerido
                                    </label>
                                </div>
                            </div>-->
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Atributo</button>
                                    <a class="btn btn-danger" href="{{ route('admin.attributes.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection