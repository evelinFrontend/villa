<?php
// echo json_encode($data);

?>
<h3>Reporte Habitaciones:</h3>
 <table class="factura-tabla"  border="1px">
    <thead>
        <tr>
            <th>Habitacion</th>
            <th>Total Efectivo</th>
            <th>Total Credito</th>
            <th>Total Transferencia</th>
            <th>Total ventas</th>
            <th>Facturas Realizadas</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $habitacion){ ?>
                <tr>
                    <td><?php echo $habitacion["habitacion"] ?></td>
                    <td><?php echo $habitacion["totalEfectivo"] ?></td>
                    <td><?php echo $habitacion["totalCredito"] ?></td>
                    <td><?php echo $habitacion["totalTransferencia"] ?></td>
                    <td><?php echo $habitacion["totalVentas"] ?></td>
                    <td><?php echo $habitacion["facturasRealizadas"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
</table>