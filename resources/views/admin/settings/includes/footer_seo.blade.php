<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        {{ csrf_field() }}
        <h3 class="tile-title">Pie &amp; SEO</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="footer_copyright_text">Pie Copyright Texto</label>
                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Ingresa pie copyright texto"
                    id="footer_copyright_text"
                    name="footer_copyright_text"
                    >{{ config('settings.footer_copyright_text') }}</textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="seo_meta_title">Meta título SEO</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ingresa título seo meta para la tienda"
                    id="seo_meta_title"
                    name="seo_meta_title"
                    value="{{ config('settings.seo_meta_title') }}"
                    />
            </div>
            <div class="form-group">
                <label class="control-label" for="seo_meta_description">Meta descripción SEO</label>
                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Ingresa la meta descripción seo para la tienda"
                    id="seo_meta_description"
                    name="seo_meta_description"
                    >{{ config('settings.seo_meta_description') }}</textarea>
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