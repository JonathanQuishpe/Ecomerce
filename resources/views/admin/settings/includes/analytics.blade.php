<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        {{ csrf_field() }}
        <h3 class="tile-title">Analítica</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="google_analytics">Google Analytics Code</label>
                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Ingresa google analytics code"
                    id="google_analytics"
                    name="google_analytics"
                    >{!! Config::get('settings.google_analytics') !!}</textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="facebook_pixels">Facebook Pixel Code</label>
                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Ingresa facebook pixel code"
                    id="facebook_pixels"
                    name="facebook_pixels"
                    >{{ Config::get('settings.facebook_pixels') }}</textarea>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar Configuración</button>
                </div>
            </div>
        </div>
    </form>
</div>