<div class="content-main">
    <div class="subcontent p-4">
        <h4 class="pricipal-title mb-4">Buscar facturas</h4>
        <div class="filter mb-4 border-bottom pb-4">
            <form id="form-search-invoice " required>
                <div class="form-row " required>
                    <div class="form-group col">
                        <label for="select-option">Buscar por:</label>
                        <select id="select-option" class="form-control">
                            <option value="number">Número de factura</option>
                            <option value="range">Rango de fecha</option>
                        </select>
                    </div>
                    <div class="form-group col number">
                        <label for="number-invoice">Numero de factura:</label>
                        <input id="number-invoice" class="form-control" type="number " required>
                    </div>
                    <div class="form-group col range">
                        <label for="date-init">Desde:</label>
                        <input id="date-init" class="form-control" type="date">
                    </div>
                    <div class="form-group col range">
                        <label for="date-finish">Hasta:</label>
                        <input id="date-finish" class="form-control" type="date">
                    </div>
                    <div class="form-group col-2 d-flex align-items-end">
                        <button class="btn btn-primary" type="submit">Buscar</button>

                    </div>
                </div>
            </form>
        </div>
        <div class="content-table">
            <table class="table table-striped col" id="table-search-invoices">
                <thead>
                    <tr>
                        <th scope="col">Factura Nro.</th>
                        <th scope="col">Nro Habitación.</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">valor</th>
                        <th scope="col">opcioones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>123123</th>
                        <td>12 jun. 2018</td>
                        <td>20.000</td>
                        <td>
                            <p>ver</p>
                            <p>imprimir</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/invoices.js"></script>