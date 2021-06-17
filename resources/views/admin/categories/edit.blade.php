@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
    </div>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="tile">
            <h3 class="tile-title">{{ $subTitle }}</h3>
            <form action="{{ route('admin.categories.update') }}" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="name">Nombre <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $targetCategory->name) }}"/>
                        <input type="hidden" name="id" value="{{ $targetCategory->id }}">
                        {{ $errors->first('name') }}
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description">Descripción</label>
                        <textarea class="form-control" rows="4" name="description" id="description">{{ old('description', $targetCategory->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="parent">Categoría Padre <span class="m-l-5 text-danger"> *</span></label>
                        <select id=parent class="form-control custom-select mt-15 {{ $errors->has('parent_id') ? 'is-invalid' : '' }}" name="parent_id">
                            <option value="0">Selecciona una categoría padre</option>
                            @foreach($categories as $key => $category)
                            @if ($targetCategory->parent_id == $key)
                            <option value="{{ $key }}" selected> {{ $category }} </option>
                            @else
                            <option value="{{ $key }}"> {{ $category }} </option>
                            @endif
                            @endforeach
                        </select>
                        {{ $errors->first('parent_id') }}
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured"
                                       {{ $targetCategory->featured == 1 ? 'checked' : '' }}
                                />Categoría Destacada
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="menu" name="menu"
                                       {{ $targetCategory->menu == 1 ? 'checked' : '' }}
                                />Mostrar Menú
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                @if ($targetCategory->image != null)
                                <figure class="mt-2" style="width: 80px; height: auto;">
                                    <img src="{{url('/')}}/{{ $targetCategory->image}}" id="categoryImage" class="img-fluid" alt="img">
                                </figure>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <label class="control-label">Imagen Caegoría</label>
                                <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="file" id="image" name="image"/>
                                {{ $errors->first('image') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar Categoría</button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection