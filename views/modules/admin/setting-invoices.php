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
<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/process.js"></script>