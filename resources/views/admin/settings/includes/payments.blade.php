<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        {{ csrf_field() }}
        <h3 class="tile-title">Configuraciones Pago</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="stripe_payment_method">Método Pago Stripe</label>
                <select name="stripe_payment_method" id="stripe_payment_method" class="form-control">
                    <option value="1" {{ (config('settings.stripe_payment_method')) == 1 ? 'selected' : '' }}>Habilitado</option>
                    <option value="0" {{ (config('settings.stripe_payment_method')) == 0 ? 'selected' : '' }}>Desabilitado</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="stripe_key">Clave</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ingrese clave stripe"
                    id="stripe_key"
                    name="stripe_key"
                    value="{{ config('settings.stripe_key') }}"
                    />
            </div>
            <div class="form-group pb-2">
                <label class="control-label" for="stripe_secret_key">Clave secreta</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ingrese clave secreta stripe"
                    id="stripe_secret_key"
                    name="stripe_secret_key"
                    value="{{ config('settings.stripe_secret_key') }}"
                    />
            </div>
            <hr>
            <div class="form-group pt-2">
                <label class="control-label" for="paypal_payment_method">Método Pago Paypal</label>
                <select name="paypal_payment_method" id="paypal_payment_method" class="form-control">
                    <option value="1" {{ (config('settings.paypal_payment_method')) == 1 ? 'selected' : '' }}>Habilitado</option>
                    <option value="0" {{ (config('settings.paypal_payment_method')) == 0 ? 'selected' : '' }}>Desabilitado</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="paypal_client_id">ID Cliente</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ingresa cliente id paypal"
                    id="paypal_client_id"
                    name="paypal_client_id"
                    value="{{ config('settings.paypal_client_id') }}"
                    />
            </div>
            <div class="form-group">
                <label class="control-label" for="paypal_secret_id">ID Secreto</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ingresa id secreto paypal"
                    id="paypal_secret_id"
                    name="paypal_secret_id"
                    value="{{ config('settings.paypal_secret_id') }}"
                    />
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