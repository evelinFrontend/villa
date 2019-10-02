<?php
// echo json_encode($data);

?>
<h3>Resumen de ingresos:</h3>
 <table class="factura-tabla"  border="1px">
    <thead>
        <tr>
            <th>Total Efectivo</th>
            <th>Total Credito</th>
            <th>Total Transferencia</th>
            <th>Total ventas</th>
        </tr>
        </thead>
        <tbody>
                <tr>
                    <td><?php echo $data["totalEfectivo"] ?></td>
                    <td><?php echo $data["totalCredito"] ?></td>
                    <td><?php echo $data["totalTransferencia"] ?></td>
                    <td><?php echo $data["totalVentas"] ?></td>
                </tr>
        </tbody>
</table>