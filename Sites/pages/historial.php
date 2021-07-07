<?php 
session_start();
  
if (isset($_SESSION['rut'])){
  include('../templates/header.html'); 
  include('../templates/body_postlogin.html');
} else {
	header("Location: ../index.php");
}
require('../config/conexion.php');

$query = "SELECT c.compra_id
          FROM usuarios AS u, compras AS c
          WHERE u.usuario_id = c.usuario_id
          AND u.rut = '".$_SESSION['rut']."'";

$result = $db -> prepare($query);
$result -> execute();
$id_compras = $result -> fetchAll();

$fecha_compras = array();

echo('hola');
foreach ($id_compras as $id) {
  
  $query = "SELECT compra_id, fecha
            FROM despachos
            WHERE compra_id = $id[0] 
            ORDER BY fecha DESC";

  $result = $db2 -> prepare($query);
  $result -> execute();
  $fecha = $result -> fetchAll();

  push_array($fecha_compras, $fecha[0]);
}

$datos_compras = array();

foreach ($fecha_compras as $f) {
  
  $query = "SELECT p.producto_id, p.nombre, p.precio, d.cantidad, t.nombre
            FROM productos AS p, compras AS c, detalle AS d, usuarios AS u, tiendas AS t
            WHERE c.compra_id = d.compra_id
            AND c.tienda_id = t.tienda_id
            AND c.usuario_id = u.usuario_id
            AND d.producto_id = p.producto_id
            AND compra_id = $f[0] 
            AND u.rut = '".$_SESSION['rut']."'";

  $result = $db -> prepare($query);
  $result -> execute();
  $datos_compra = $result -> fetchAll();

  push_array($datos_compra[0], f[1]);
  push_array($datos_compras, $datos_compra[0]);
}

?>

<table class='table'>
    <thead>
        <tr>
        <th>ID Producto</th>
        <th>Producto</th>
        <th>Total $</th>
        <th>Unidades</th>
        <th>ID Tienda</th>
        <th>Tienda</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($datos_compras as $d) {
          echo "<tr> <td>$d[0]</td> <td>$d[1]</td> <td>$d[2]</td>
                <td>$d[3]</td> <td>$d[4]</td> <td>$d[5]</td> </tr>";
        }
        ?>
    </tbody>
</table>