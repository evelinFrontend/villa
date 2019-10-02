<?php
// echo json_encode($data);
?>
<h3>INVENTARIO :<?php date("Y-m-d");?></h3>
 <table class="factura-tabla"  border="1px">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Nombre Producto</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Cantidad Disponible</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $producto){ ?>
                <tr>
                    <td><?php echo $producto->pro_codigo ?></td>
                    <td><?php echo $producto->pro_nombre ?></td>
                    <td><?php echo $producto->pro_precio_compra ?></td>
                    <td><?php echo $producto->pro_precio_venta ?></td>
                    <td><?php echo $producto->pro_cantidad_disponible ?></td>
                </tr>
            <?php } ?>
        </tbody>
</table>