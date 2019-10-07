<?php 
// echo json_encode($data);
?>
<h3>Cortesias Realizadas:</h3>
 <table class="factura-tabla"  border="1px">
    <thead>
        <tr>
            <th>Cosecutivo Cortesia</th>
            <th>Numero Habitación</th>
            <th>Fecha Ingreso</th>
            <th>Personas Adicionales</th>
            <th>Habitación Decorada</th>
            <th>Hora Salida</th>
            <th>Duración Cortesias</th>
            <th>Tipo Pago</th>
            <th>Valor Efectivo</th>
            <th>Valor Credito</th>
            <th>Valor Transferencia</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $cortesia){?>
                <tr>
                    <td><?php echo $cortesia->cor_consecutivo ?></td>
                    <td><?php echo $cortesia->hab_numero ?></td>
                    <td><?php echo $cortesia->cor_fecha_hora_ingreso ?></td>
                    <td><?php echo $cortesia->cor_numero_personas_adicionales ?></td>
                    <td><?php echo $cortesia->cor_habitacion_decorada ?></td>
                    <td><?php echo $cortesia->cor_hora_salida ?></td>
                    <td><?php echo $cortesia->valor_cortesia ?></td>
                    <td><?php echo $cortesia->tipo_pago ?></td>
                    <td><?php echo $cortesia->cor_valor_efectivo ?></td>
                    <td><?php echo $cortesia->cor_valor_credito ?></td>
                    <td><?php echo $cortesia->cor_valor_transferencia ?></td>
                </tr>
            <?php } ?>
        </tbody>
</table>