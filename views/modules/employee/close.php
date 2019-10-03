<div class="content-main" id="content-close">
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Cierre de turno</h4>
        <p>Al momento de cerrar la aplicación te llevará al inicio de sesion.</p>
        <div class="alert alert-danger" role="alert"></div>
        <div class="row mt-4">
            <div class="col">
                <p>Factura de Inicio</p>
                <h6 id="facInit"></h6>
            </div>
            <div class="col">
                <p>Factura de finalización</p>
                <h6 id="facEnd"></h6>
            </div>
            <div class="col">
            <p>Numero de facturas</p>
                <h6 id="facnum"></h6>
            </div>
        </div>
        <form >
            <div class="row mt-4">
                <div class="form-group col">
                    <label for="cierre-input">Valor en caja:</label>
                    <input id="cierre-input" class="form-control" type="number">
                </div>
                <div class="form-group col mt-2">
                    <button type="button" id="cierre" class="btn btn-primary btn-block mt-4">Cerrar turno</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="views/assets/js/close.js"></script>