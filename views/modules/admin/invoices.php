<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50" id="section-1">
            <p>Buscar facturas</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Configuracion de facturas</p>
        </div>
    </div>
    <div class="subcontent p-4" id="section-1-tab">
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
    <div class="subcontent p-4" id="section-2-tab">
        <h4 class="pricipal-title mb-4">Configurar Facturas</h4>
        <div class="d-flex justify-content-end mb-4" role="group" aria-label="Vertical button group">
            <button type="button" class="btn btn-primary ml-4" data-toggle="modal" data-target="#modal-iva">
                Definir IVA
            </button>
        </div>
        <form id="config-invoce">
            <div class="row">
                <div class="form-group col">
                    <label for="prefix">Prefifo:</label>
                    <input id="prefix" class="form-control" type="text " required>
                </div>
                <div class="form-group col">
                    <label for="resolution">Resolución:</label>
                    <input id="resolution" class="form-control" type="text " required>
                </div>
                <div class="form-group col">
                    <label for="nit">Nit:</label>
                    <input id="nit" class="form-control" type="text " required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="business-name">Razón social:</label>
                    <input id="business-name" class="form-control" type="text " required>
                </div>
                <div class="form-group col">
                    <label for="description">Descripción:</label>
                    <input id="description" class="form-control" type="text " required>
                </div>
                <div class="form-group col">
                    <label for="phone">Teléfono:</label>
                    <input id="phone" class="form-control" type="text " required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="adress">Dirección:</label>
                    <input id="adress" class="form-control" type="text " required>
                </div>
                <div class="form-group col">
                    <label for="city">Ciudad:</label>
                    <input id="city" class="form-control" type="text " required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="config-date-init">fecha inicial:</label>
                    <input id="config-date-init" class="form-control" type="date" required>
                </div>
                <div class="form-group col">
                    <label for="config-date-finish">Fecha final:</label>
                    <input id="config-date-finish" class="form-control" type="date" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="range-init">Rango inicial:</label>
                    <input id="range-init" class="form-control" type="text " required>
                </div>
                <div class="form-group col">
                    <label for="range-finish">Rango final:</label>
                    <input id="range-finish" class="form-control" type="text " required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="text">Leyenda:</label>
                    <textarea id="text" class="form-control" rows="3"></textarea>
                </div>
                <div class="custom-file col">
                    <input id="img-product" class="custom-file-input" type="file"
                        accept="image/gif, image/jpeg, image/png">
                    <label for="img-product" class="custom-file-label">Imagen:</label>
                </div>
            </div>
            <div class="alert alert-danger" role="alert"></div>
            <div class="alert alert-success" role="alert"></div>
            <button class="btn btn-primary" type="submit">Guardar Cambios</button>
        </form>
    </div>
</div>
<div id="modal-iva" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="mb-4">El valor que definas aquí será el que se adicione en la factura, este valor sera en
                    porcentaje.</p>
                <form action="">
                    <div class="form-group">
                        <label for="value-iva">IVA:</label>
                        <input id="value-iva" class="form-control" type="number" name="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/invoices.js"></script>