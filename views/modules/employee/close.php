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
            <div class="col">
            <p>Valor al iniciar turno</p>
                <h6 id="valorAbriCaja"></h6>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
            <p>Cortesias Realizadas</p>
                <h6 id="cantidadCortesias"></h6>
            </div>
            <div class="col">
            <p>Valor Cortesias</p>
                <h6 id="ValorTotalCortesias"></h6>
            </div>
            <div class="col">
            <p>Facturas Anuladas</p>
                <h6 id="cantidaFacturasAnuladas"></h6>
            </div>
        </div>
        <form >
            <div class="row mt-4">
                <div class="form-group col">
                    <label for="cierre-input">Valor  de facturas realizadas:</label>
                    <input id="cierre-input" class="form-control" type="number" disabled>
                </div>
            </div>
            <div class="row mt-4">
                <div class="form-group col">
                    <label for="caja-input">Valor en caja:</label>
                    <input id="caja-input" class="form-control" type="number" disabled>
                </div>
                <div class="form-group col mt-2">
                    <button type="button" id="cierreTurno" class="btn btn-primary btn-block mt-4">Cerrar turno</button>
                </div>
                <div class="form-group col mt-2">
                    <button type="button" id="cierreDeDia" class="btn btn-primary btn-block mt-4">Cerrar Dia</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="printClose" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center my-4">¿Desea imprimir datos del cierre de turno?</p>
                <button type="button" id="btn-print" class="btn btn-primary">Imprimir comprobante</button>
                <button type="button" id="btn-close" class="btn btn-outline-primary ">Cerrar turno</button>
            </div>
        </div>
    </div>
</div>
<div id="content-print" class="text-center">
    <span id="close-print">cerrar X</span>
        <h6 id="title-unit-box">Villa campestre</h6>
        <p class="mb-4">Detalle de cierre de turno</p>
        <div class="col-6">
        <div class="d-flex justify-content-between">
            <strong>Factura de inicio:</strong>
            <p id="p-data-init"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Factura de cierre:</strong>
            <p id="p-data-end"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Numero de facturas:</strong>
            <p id="p-fac-number"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Valor de facturas:</strong>
            <p id="p-valor-fac-number"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Numero de Cortesias:</strong>
            <p id="p-cor-number"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Valor de Cortesias:</strong>
            <p id="p-valor-cor-number"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Reservas Anuladas:</strong>
            <p id="p-anulada-number"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Valor al iniciar turno:</strong>
            <p id="p-value-init"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Valor en caja:</strong>
            <p id="p-value-end"></p>
        </div>
        </div>
</div>
<script src="views/assets/js/close.js"></script>