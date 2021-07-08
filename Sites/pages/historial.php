<?php 
session_start();

echo "<body style='background-color:#E6EAEB'>";

$_SESSION['previous_location'] = 'historial.php';
  
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
$counter = 0;
foreach ($id_compras as $id) {
  
  $query = "SELECT compra_id, fecha
            FROM despachos
            WHERE compra_id = $id[0] 
            ORDER BY fecha DESC";

  $result = $db2 -> prepare($query);
  $result -> execute();
  $fecha = $result -> fetchAll();
  array_push($fecha_compras, [$counter => $fecha[0]]);
  $counter = $counter + 1;
}
$datos_compras = array();

krsort($fecha_compras);

foreach ($fecha_compras as $f) {
  foreach ($f as $f2) {
    $query = "SELECT p.producto_id, p.nombre, p.precio, d.cantidad, t.tienda_id, t.nombre
              FROM productos AS p, compras AS c, detalle AS d, usuarios AS u, tiendas AS t
              WHERE c.compra_id = d.compra_id
              AND c.tienda_id = t.tienda_id
              AND c.usuario_id = u.usuario_id
              AND d.producto_id = p.producto_id
              AND c.compra_id = $f2[0] 
              AND u.rut = '".$_SESSION['rut']."'";

    $result = $db -> prepare($query);
    $result -> execute();
    $datos_compra = $result -> fetchAll();
    array_push($datos_compra[0], $f2[1]);
    array_push($datos_compras, $datos_compra[0]);
  }
}

?>

<table class='table'>
    <thead>
        <tr>
        <th>ID Producto</th>
        <th>Producto</th>
        <th>Total $</th>
        <th>Unidades</th>
        <th>Tienda</th>
        <th>Fecha de la compra</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($datos_compras as $d) {
          $total = $d[2] * $d[3];
          echo "<tr> <td>$d[0]</td> <td><a href='productos.php?id={$d[0]}'>$d[1]</a></td> <td>$total</td>
                <td>$d[3]</td> <td><a href='tiendas2.php?id={$d[4]}'>$d[5]</a></td>
                <td>$d[6]</td> </tr>";
        }
        ?>
    </tbody>
</table>