<?php 
// echo json_encode($data);
?>
<h3>Reservas Anuladas:</h3>
 <table class="factura-tabla"  border="1px">
    <thead>
        <tr>
            <th>Numero Habitación</th>
            <th>Fecha</th>
            <th>Habitación Decorada</th>
            <th>Motivo</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $cortesia){?>
                <tr>
                    <td><?php echo $cortesia->hab_numero ?></td>
                    <td><?php echo $cortesia->ranula_fecha_hora_ingreso ?></td>
                    <td><?php echo $cortesia->ranula_habitacion_decorada ?></td>
                    <td><?php echo $cortesia->ranula_motivo ?></td>
                </tr>
            <?php } ?>
        </tbody>
</table>