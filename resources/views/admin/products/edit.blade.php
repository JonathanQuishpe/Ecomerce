@extends('admin.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/>
@endsection
@section('title') {{ $pageTitle }} @endsection
@section('content')
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
                <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Imagenes</a></li>
                <li class="nav-item"><a class="nav-link" href="#attributes" data-toggle="tab">Atributos</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div class="tile">
                    <form action="{{ route('admin.products.update') }}" method="POST" role="form">
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
                                    value="{{ old('name', $product->name) }}"
                                    />
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                                            value="{{ old('sku', $product->sku) }}"
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
                                        <select name="brand_id" id="brand_id" class="form-control { $errors->has('brand_id') ? 'is-invalid' : '' }}">
                                            <option value="0">Select a brand</option>
                                            @foreach($brands as $brand)
                                            @if ($product->brand_id == $brand->id)
                                            <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                            @else
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endif
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
                                        <label class="control-label" for="categories">Categorías</label>
                                        <select name="categories[]" id="categories" class="form-control" multiple>
                                            @foreach($categories as $category)
                                            @php $check = in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : ''@endphp
                                            <option value="{{ $category->id }}" {{ $check }}>{{ $category->name }}</option>
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
                                            value="{{ old('price', $product->price) }}"
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
                                            placeholder="Ingrese precio espcial del producto"
                                            id="sale_price"
                                            name="sale_price"
                                            value="{{ old('sale_price', $product->sale_price) }}"
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
                                            value="{{ old('quantity', $product->quantity) }}"
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
                                            value="{{ old('weight', $product->weight) }}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="description">Descripción</label>
                                <textarea name="description" id="description" rows="8" class="form-control">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="status"
                                               name="status"
                                               {{ $product->status == 1 ? 'checked' : '' }}
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
                                               {{ $product->featured == 1 ? 'checked' : '' }}
                                        />Destacado
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar Producto</button>
                                    <a class="btn btn-danger" href="{{ route('admin.products.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane" id="images">
                <div class="tile">
                    <h3 class="tile-title">Subir Imagen</h3>
                    <hr>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="button" id="uploadButton">
                                    <i class="fa fa-fw fa-lg fa-upload"></i>Subir Imagenes
                                </button>
                            </div>
                        </div>
                        @if ($product->images)
                        <hr>
                        <div class="row">
                            @foreach($product->images as $image)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{url('/')}}/{{$image->full }}" id="brandLogo" class="img-fluid" alt="img">
                                        <a class="card-link float-right text-danger" href="{{ route('admin.products.images.delete', $image->id) }}">
                                            <i class="fa fa-fw fa-lg fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="attributes">
                <product-attributes :productid="{{ $product->id }}"></product-attributes>
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
    });</script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
    $('#categories').select2();
    let myDropzone = new Dropzone("#dropzone", {
    paramName: "image",
            addRemoveLinks: false,
            maxFilesize: 4,
            parallelUploads: 2,
            uploadMultiple: false,
            url: "{{ route('admin.products.images.upload') }}",
            autoProcessQueue: false,
    });
    myDropzone.on("queuecomplete", function (file) {
    window.location.reload();
    showNotification('Completado', 'Archivos subidos', 'success', 'fa-check');
    });
    $('#uploadButton').click(function(){
    if (myDropzone.files.length === 0) {
    showNotification('Error', 'Por favor seleccione archivos para subirlos.', 'danger', 'fa-close');
    } else {
    myDropzone.processQueue();
    }
    });
    function showNotification(title, message, type, icon)
    {
    $.notify({
    title: title + ' : ',
            message: message,
            icon: 'fa ' + icon
    }, {
    type: type,
            allow_dismiss: true,
            placement: {
            from: "top",
                    align: "right"
            },
    });
    }
    });</script>
<script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>
@endpush