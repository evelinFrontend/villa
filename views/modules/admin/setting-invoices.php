<div class="content-main">
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Reorganización De faturas</h4>
        <form id="deleteInvoices">
            <div class="row">
            <div class="form-group col">
                <label for="date-init">Desde:</label>
                <input id="date-init" class="form-control" type="date">
            </div>
            <div class="form-group col">
                <label for="date-fin">Hasta</label>
                <input id="date-fin" class="form-control" type="date">
            </div>
            <div class="pt-2">
                <button class="btn btn-primary mt-4" type="submit">Buscar</button>
            </div>
            </div>
        </form>

        <form id="confirmProcess">
            <div class="row">
            <div class="form-group col">
                <label for="valorTotal">Valor total:</label>
                <input id="valorTotal" class="form-control" type="text" disabled>
            </div>
            <div class="form-group col">
                <label for="porcentaje">Porcentaje a Eliminar:</label>
                <input id="porcentaje" class="form-control" type="number">
            </div>
            <div class="pt-2">
                <button class="btn btn-primary mt-4" type="submit" id="realizarProceso">Realizar Proceso</button>
            </div>
            </div>
        </form>

        <div class="content-table">
            <table class="table table-striped col" id="table-process">
                <thead>
                    <tr>
                        <th scope="col">Factura Nro.</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">valor</th>
                        <th scope="col">Tipo de pago</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modal-preview-proceso" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status">El Resultado del proceso Sera:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                        <div id="infoProcessPreview"></div>
                        <h3>Facturas Eliminadas:</h3>
                        <table class="table table-striped col" id="previewFacturasEliminasdas">
                            <thead>
                                <tr>
                                    <th scope="col">Factura Nro.</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">valor</th>
                                    <th scope="col">Tipo de pago</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                    </table>
                        <h3>Facturas que cambiaran de consecutivo:</h3>
                        <table class="table table-striped col" id="previewFacturasReorganizadas">
                            <thead>
                                <tr>
                                    <th scope="col">Factura Nro.</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">valor</th>
                                    <th scope="col">Tipo de pago</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                    </table>
                        
                    <button class="btn btn-primary" type="button" id="RealizarProcesoConfirmado">Deseo Realizar el preceso</button>
                    <button class="btn btn-primary" type="button">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/process.js"></script>