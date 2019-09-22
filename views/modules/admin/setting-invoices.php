<div class="content-main">
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Listado de productos</h4>
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
        <div class="content-table">
        <button class="btn btn-primary m-4" type="button" id="btnDeleteInvoices">Eliminar Facturas</button>
            <table class="table table-striped col" id="table-product">
                <thead>
                    <tr>
                        <th scope="col">Factura Nro.</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">valor</th>
                        <th scope="col">opciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>