<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50" id="section-1">
            <p>Buscar facturas</p>
        </div>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <div class="slide-item w-50 border-slide" id="section-2">
                <p>Configuracion de facturas</p>
            </div>
        <?php } ?>
    </div>
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Buscar facturas</h4>
        <div class="filter mb-4 border-bottom pb-4">
            <form id="form-search-invoice">
                <div class="form-row ">
                    <div class="form-group col">
                        <label for="select-option">Buscar por:</label>
                        <select id="select-option" class="form-control">
                            <option value="fac_consecutivo">Número de factura</option>
                            <option value="id_reserva">Número de Reserva</option>
                            <option value="range">Rango de fecha</option>
                        </select>
                    </div>
                    <div class="form-group col number">
                        <label for="number-invoice">Valor a buscar:</label>
                        <input id="number-invoice" class="form-control" type="number">
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
                        <th scope="col">Tipo de pago</th>
                        <th scope="col">opciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
    <div class="subcontent p-4" id="section-2-tab">
        <h4 class="pricipal-title mb-4">Configurar Facturas</h4>
        <div class="alert alert-success" role="alert">
        </div>
        <div class="d-flex justify-content-end mb-4" role="group" aria-label="Vertical button group">
            <button type="button" class="btn btn-primary ml-4" data-toggle="modal" data-target="#modal-iva">
                Definir IVA
            </button>
        </div>
        <form id="config-invoce">
            <div class="row">
                <div class="form-group col">
                    <label for="name">Nombre de la empresa:</label>
                    <input id="name" class="form-control" type="text" required>
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
                <div class="alert alert-danger" role="alert">
                </div>
                <form id="update-config">
                    <div class="form-group">
                        <label for="value-iva">IVA:</label>
                        <input id="value-iva" class="form-control" type="number" name="">
                    </div>
                    <div class="form-group">
                        <label for="min-cort">Minutos de cortesia:</label>
                        <input id="min-cort" class="form-control" type="number" name="">
                    </div>
                    <div class="form-group">
                        <label for="dec-hab">Valor habitación decorada:</label>
                        <input id="dec-hab" class="form-control" type="number" name="">
                    </div>
                    <div class="form-group">
                        <label for="minutosCobrar">Minutos despues del cual se cobrara otra hora:</label>
                        <input id="minutosCobrar" class="form-control" type="number" name="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- content invoces printer -->
<div id="content-print" class="text-center">
    <span id="close-print">cerrar X</span>
    <div class="col-6">
        <h6 id="razonSocialFAC"></h6>
        <p id="nombreEmpresaFAC"></p>
        <p id="nitFAC"></p>
        <p id="direccionFAC"></p>
        <small id="numeroTelFac"></small>
        <small id="ciudadFAC"></small>
        <p id="resolucionFAC"></p>
    </div>
    <div class="data-invoces">
        <h6 class="my-4" id="title-unit-box">Caja unica de venta</h6>
        <div class="d-flex justify-content-between">
            <strong>Factura de venta No:</strong>
            <p id="numeroFacturaFAC"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>habitación No:</strong>
            <p id="habitacionNumFAC"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Entrada:</strong>
            <p id="horaEntradaFAC"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>salida:</strong>
            <p id="horaSalidaFAC"></p>
        </div>
        <div class="tabla mt-4">
            <table class="factura-tabla">
                <thead>
                    <tr>
                        <th>descripcion del servicio</th>
                        <th>valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="descTiempoFAC"></td>
                        <td id="valorTiempoFAC"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h6 class="my-2" id="DescProduct">Descrpcion de producto</h6>
        <div class="tabla mb-4">
            <table class="factura-tabla" id="tableProductsFAC">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cant.</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Valor productos:</strong>
            <p id="valorProductosTotalFAC"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Base:</strong>
            <p id="valorBaseIvaFAC"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Subtotal:</strong>
            <p id="subtotalFAC"></p>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Iva:</strong>
            <strong id="valorIvaFAC"></strong>
        </div>
        <div class="d-flex justify-content-between">
            <strong>TOTAL:</strong>
            <strong id="valorTotalFAC"></strong>
        </div>
        <h6 id="formasDePagoFAC">Forma de pago</h6>
    <p id="mensajeFooterFAC" class="mt-4"></p>

</div>




<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/invoices.js"></script>