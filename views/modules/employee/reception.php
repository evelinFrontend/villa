<div class="content-main" id="reception">
    <div class="row" id="content-card"></div>
</div>
<div class="row" id="invoices">
    <div class="content-main-recep left col-8">
        <div class="subcontent p-4">
            <h4 class="pricipal-title">reservar</h4>
            <p class="mb-4">Para cambiar el estado de la habitación debes ingresar los que a continuación se muestran.
            </p>
            <div class="alert alert-danger" role="alert"></div>
            <form id="form-invoices">
                <div class="row">
                    <div class="form-group col">
                        <label for="courtesy">Promociones:</label>
                        <select id="courtesy" class="form-control">
                            <option value="">N/A</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="cortesia">Cortesia:</label>
                        <select id="cortesia" class="form-control">
                            <option value="0">N/A</option>
                            <option value="1">1 Hora</option>
                            <option value="2">2 Horas</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="select-person">Persona adicional:</label>
                        <select id="select-person" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Si</option>
                        </select>
                    </div>
                    <div class="form-group col" id="content-additional">
                        <label for="additional">¿Cuantas?</label>
                        <input id="additional" class="form-control" type="number" value="0" required>
                    </div>
                    <div class="form-group col">
                        <label for="decorated-room">habitación decorada:</label>
                        <select id="decorated-room" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>
                </div>
                <div class="m-4 border-bottom">
                    <h5>Seleccionar productos</h5>
                    <div id="modal-content-products" class="col">
                        <input class="form-control mb-2" type="search" placeholder="Buscar..." id="search">
                    </div>
                </div>
                <div class="form-group">
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <button class="btn btn-primary" type="submit" id="btn-reservar">Reservar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="content-main-recep col-4 ">
        <div class="subcontent p-4">
            <h5>TOTAL: <strong id="total"></strong></h5>
            <div id="select-products"></div>
            <table class="table table-striped table-sm " id="cant-products-table">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">cantidad</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div class="row" id="reserva">
    <div class="content-main-recep left col-8">
        <div class="subcontent p-4">
            <h4 class="pricipal-title"><img src="views/assets/icons/angle-left-solid.svg" class="icon-menu mr-3 goReception"> Facturar</h4>
            <div class="row justify-content-end mb-4 mr-2">
                <button class="btn btn-outline-dark" id="edit">Editar</button>
                <button class="btn btn-outline-dark" id="cancel-edit">Cancelar edicion</button>
                <button class="btn btn-outline-dark ml-4" id="print-parcial">Imprimir tiempo parcial</button>
            </div>
            <div class="alert alert-danger" role="alert"></div>
            <div class="row" id="detail-reserva"></div>
            <form id="form-reserva">
                <div class="row input-form-reserva">
                    <div class="form-group col">
                        <label for="courtesy-re">Promociones:</label>
                        <select id="courtesy-re" class="form-control">
                            <option value="">N/A</option>
                        </select>
                    </div>
                    <div class="form-group col cortesia-re">
                        <label for="cortesia-re">Cortesia:</label>
                        <select id="cortesia-re" class="form-control">
                            <option value="0">N/A</option>
                            <option value="1">1 Hora</option>
                            <option value="2">2 Horas</option>
                        </select>
                    </div>
                </div>
                <div class="row input-form-reserva">
                    <div class="form-group col">
                        <label for="select-person-re">Persona adicional:</label>
                        <select id="select-person-re" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Si</option>
                        </select>
                    </div>
                    <div class="form-group col" id="content-additional-re">
                        <label for="additional">¿Cuantas?</label>
                        <input id="additional" class="form-control" type="number" value="0" required>
                    </div>
                    <div class="form-group col">
                        <label for="decorated-room">habitación decorada:</label>
                        <select id="decorated-room" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>
                </div>
                <div class="m-4 border-bottom">
                    <h5>Seleccionar productos</h5>
                    <div id="modal-content-products-re" class="col">
                        <input class="form-control mb-2" type="search" placeholder="Buscar..." id="search">
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-end" role="group">
                        <button class="btn btn-primary" type="button" id="btn-reservar">Cancelar</button>
                        <button class="btn btn-primary ml-4" type="submit" id="btn-facturar">Facturar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="content-main-recep col-4 ">
        <div class="subcontent p-4">
            <h5>TOTAL: <strong id="TOTAL-INVOICE-SHOW"></strong></h5>
            <div id="select-products"></div>
            <table class="table table-striped table-sm " id="cant-products-table">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">cantidad</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?php if($_SESSION["DATA_USER"]["ROL"]==2){?>
<div id="init-modal" class="modal ade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center">Ingresa el cantidad de dinero que se encuentra en caja en este momento</p>
                <div class="alert alert-danger" role="alert">
                </div>
                <form id="turn">
                    <div class="form-group">
                        <label for="value">Valor en caja</label>
                        <input id="value" class="form-control" type="number">
                        <div class="invalid-feedback" id="mss-err-username">
                            Llena este campo para continuar
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div id="modal-cancel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status">Cancelar reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <form id="cancelar-reserva">
                    <div class="form-group">
                        <label for="my-textarea">Motivo</label>
                        <textarea id="my-textarea" class="form-control" rows="3" require></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Cancelar reserva</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal-type-pay" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <h3 class="text-center mt-3">Saldo total: <b id="modalTotal"></b></h3>
            <div class="modal-body">
                <div class="alert alert-danger a-modal-danger" role="alert">
                </div>
                <div class="form-group">
                    <label for="type-pay">Selecciona un metodo de pago</label>
                    <select id="type-pay" class="form-control" name="">
                        <option value="efectivo">Efectivo</option>
                        <option value="credito">Credito</option>
                        <option value="transferencia">Transferencia</option>
                        <option value="mixto">Mixto</option>
                    </select>
                </div>
                <div class="form-group" id="efectivo">
                    <label for="input-efectivo">Efectivo</label>
                    <input id="input-efectivo" class="form-control" type="number" reuired>
                </div>
                <div class="form-group" id="credito">
                    <label for="input-credito">Credito</label>
                    <input id="input-credito" class="form-control" type="number" reuired>
                </div>
                <div class="form-group" id="transferencia">
                    <label for="input-transferencia">Transferencia</label>
                    <input id="input-transferencia" class="form-control" type="number" reuired>
                </div>
                <button class="btn btn-primary" type="button" id="btn-aceptar-metodo">Facturar</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-printer" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>¿Deseas imprimir la factura?</h4>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-dark">Ir a recepcion</button>
                    <button type="button" class="btn btn-success" id="btn-print">Imprimir</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content-print" class="text-center">
    <span id="close-print">cerrar X</span>
    <div class="col-6">
        <h6 id=razonSocialFAC"></h6>
        <p id="nombreEmpresaFAC"></p>
        <p id="nitFAC"></p>
        <p id="direccionFAC"></p>
        <small id="numeroTelFac"></small>
        <small id="ciudadFAC"></small>
        <p id="resolucionFAC"></p>
        <p>vigencia 24meses</p>
    </div>
    <div class="col-6">
        <h6 class="my-4 ">Caja unica de venta</h6>
        <div class="d-flex justify-content-between">
            <strong>Factura de venta No:</strong>
            <p id="numeroFacturaFAC"></p>
        </div>
        <!-- <div class="d-flex justify-content-between border-bottom pb-4">
            <strong>Factura de venta No:</strong>
            <p>4343</p>
        </div> -->
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
                <tbody >
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
        <p id="mensajeFooterFAC"></p>

    </div>
</div>
<script src="views/assets/js/reception.js"></script>