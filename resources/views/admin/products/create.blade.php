@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
=@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} - {{ $subTitle }}</h1>
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
                    <form action="{{ route('admin.products.store') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <h3 class="tile-title">Información Producto</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="name">Nombre</label>
                                <input
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    type="text"
                                    placeholder="Ingrese nombre del producto"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    />
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> 
                                    <span>{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="sku">Referencia/Código</label>
                                        <input
                                            class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}"
                                            type="text"
                                            placeholder="Ingrese código del producto"
                                            id="sku"
                                            name="sku"
                                            value="{{ old('sku') }}"
                                            />
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                                            <span>{{ $errors->first('sku') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="brand_id">Marca</label>
                                        <select name="brand_id" id="brand_id" class="form-control {{ $errors->has('brand_id') ? 'is-invalid' : '' }}">
                                            <option value="0">Select a brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                                            <span>{{ $errors->first('brand_id') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="categories">Categoría</label>
                                        <select name="categories[]" id="categories" class="form-control" multiple>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="price">Precio</label>
                                        <input
                                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            type="text"
                                            placeholder="Ingrese precio del producto"
                                            id="price"
                                            name="price"
                                            value="{{ old('price') }}"
                                            />
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                                            <span>{{ $errors->first('price') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="sale_price">Precio Especial</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder="Ingrese precio especial del producto"
                                            id="sale_price"
                                            name="sale_price"
                                            value="{{ old('sale_price') }}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="quantity">Cantidad</label>
                                        <input
                                            class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                                            type="number"
                                            placeholder="Ingrese cantidad del producto"
                                            id="quantity"
                                            name="quantity"
                                            value="{{ old('quantity') }}"
                                            />
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                                            <span>{{ $errors->first('quantity') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="weight">Peso</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder="Ingrese peso del producto"
                                            id="weight"
                                            name="weight"
                                            value="{{ old('weight') }}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="description">Descripción</label>
                                <textarea name="description" id="description" rows="8" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="status"
                                               name="status"
                                               />Estado
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="featured"
                                               name="featured"
                                               />Destacado
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Producto</button>
                                    <a class="btn btn-danger" href="{{ route('admin.products.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>
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
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#categories').select2();
    });
</script>
@endpush