<?php
// echo json_encode($data);

?>
<h3>Facturas Realizadas:</h3>
 <table class="factura-tabla"  border="1px">
    <thead>
        <tr>
            <th>Consecutivo</th>
            <th>Habitación</th>
            <th>Personas Adicionales</th>
            <th>Fecha y Hora salida</th>
            <th>Valor total</th>
            <th>Tipo Pago</th>
            <th>Tiempo Transcurrido</th>
            <th>Pagado en efectivo</th>
            <th>Pagado en credito</th>
            <th>Pagado en transferencia</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data["facturasRealizadas"] as $factura){ ?>
                <tr>
                    <td><?php echo $factura->fac_consecutivo ?></td>
                    <td><?php echo $factura->hab_numero ?></td>
                    <td><?php echo $factura->fac_numero_personas_adicionales ?></td>
                    <td><?php echo $factura->fac_hora_salida ?></td>
                    <td><?php echo $factura->valor_factura ?></td>
                    <td><?php echo $factura->tipo_pago ?></td>
                    <td><?php echo $factura->tiempo_total ?></td>
                    <td><?php echo $factura->fac_valor_efectivo ?></td>
                    <td><?php echo $factura->fac_valor_credito ?></td>
                    <td><?php echo $factura->fac_valor_transferencia ?></td>
                </tr>
            <?php } ?>
        </tbody>
</table>
<h3>Productos Vendidos:</h3>
 <table class="factura-tabla"  border="1px">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Consecutivo</th>
            <th>Cantidad</th>
            <th>Precio Compra</th>
            <th>Valor unidad</th>
            <th>Valor total</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data["productosVendidos"] as $factura){ ?>
                <?php foreach($factura as $producto){ ?>
                    <tr>
                        <td><?php echo $producto->pro_nombre ?></td>
                        <td><?php echo $producto->fac_consecutivo ?></td>
                        <td><?php echo $producto->det_cantidad ?></td>
                        <td><?php echo $producto->det_pro_precio_compra ?></td>
                        <td><?php echo $producto->det_valor_unidad ?></td>
                        <td><?php echo $producto->det_valor_total ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
</table>

<h3>Ventas:</h3>
<table class="factura-tabla" border="1px">
    <thead>
        <tr>
            <th>Cantidad De facturas</th>
            <th>Total Efectivo</th>
            <th>Total Credito</th>
            <th>Total Transferencias</th>
            <th>Total ventas</th>
        </tr>
        </thead>
        <tbody>
            <td><?php echo $data["catidadDeFacturas"] ?></td>
            <td><?php echo $data["totalEfectivo"] ?></td>
            <td><?php echo $data["totalCredito"] ?></td>
            <td><?php echo $data["totalTransferencia"] ?></td>
            <td><?php echo $data["totalVentas"] ?></td>
        </tbody>
</table>
