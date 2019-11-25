<div id="content-print">
    <span id="close-print">cerrar X</span>
    <div class="text-center">
        <h6 id="razonSocialFAC"></h6>
        <p id="nombreEmpresaFAC"></p>
        <p id="nitFAC"></p>
        <p id="direccionFAC"></p>
        <small id="numeroTelFac"></small>
        <small id="ciudadFAC"></small>
        <p id="resolucionFAC"></p>
    </div>
    <div>
        <div class="data-time">
            <h6 class="my-4" id=" title-parcial-time"> Imprimir Tiempo parcial</h6>
            <div class="d-flex justify-content-between">
                <strong>Reserva:</strong>
                <p id="reservaID"></p>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Numero Habitación:</strong>
                <p id="numhab"></p>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Ingreso:</strong>
                <p id="horaEntradaTP"></p>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Salida:</strong>
                <p id="horaSalidaTP"></p>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Tiempo transcurrido:</strong>
                <p id="timetrancurrido"></p>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Valor Tiempo:</strong>
                <p id="valorTiempoParcial"></p>
            </div>
            <h6 class="my-5" id=" title-parcial-time">Control de tiempo parcial</h6>
            <div class="tabla mb-4">
                <table class="factura-tabla">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cant.</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody id="tableProductsTIME">
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between">
                <h5>TOTAL:</h5>
                <h5 id="totalTiempoParcial"></h5>
            </div>

        </div>
    </div>
    <!-- FATURA -->
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
        <h6 id="habitacionDecorada"></h6>
        <h6 id="formasDePagoFAC">Forma de pago</h6>

    </div>
    <p id="mensajeFooterFAC"></p>

</div>
</div>