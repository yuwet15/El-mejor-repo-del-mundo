<?php 
session_start();


$_SESSION['previous_location'] = 'historial.php';
  
if (isset($_SESSION['rut'])){
  include('../templates/header.html'); 
  include('../templates/body_postlogin.html');
} else {
	header("Location: ../index.php");
}
require('../config/conexion.php');

function date_sort($a, $b) {
    return strtotime($a['3']) - strtotime($b['3']);
}




$query = "SELECT c.compra_id, c.tienda_id, c.direccion_id
          FROM usuarios AS u, compras AS c
          WHERE u.usuario_id = c.usuario_id
          AND u.rut = '".$_SESSION['rut']."'";

$result = $db -> prepare($query);
$result -> execute();
$id_compras = $result -> fetchAll();

$counter = 0;
foreach ($id_compras as $id) {
  $query = "SELECT fecha
            FROM despachos
            WHERE compra_id = $id[0] 
            ORDER BY fecha DESC";

  $result = $db2 -> prepare($query);
  $result -> execute();
  $fecha = $result -> fetchAll();
  array_push($id_compras, ['3' => $fecha[0][0]]);
}
usort($id_compras, "date_sort");
/*
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
}*/

?>
<br>
<div class="container" style="background-color:#dce1e3">
  <table class='table'>
      <thead>
          <tr>
          <th>ID Compra</th>
          <th>Total $</th>
          <th>Tienda</th>
          <th>Direccion despacho</th>
          <th>Fecha de la compra</th>
          </tr>
      </thead>
      <tbody>
          <?php
          foreach ($id_compras as $d) {
            /*$total = $d[2] * $d[3];
            if(!$d[6]){
              $d[6] = 'Sin registro';
            }*/
            echo "<tr> 
                    <td>$d[0]</td> 
                    <td><a href='productos.php?id={$d[0]}'>Caca</a></td> 
                    <td>$d[1]</td>
                    <td>$d[2]</td> 
                    <td><a href='tiendas2.php?id={$d[1]}'>$d[3]</a></td> 
                  </tr>";
          }
          ?>
      </tbody>
  </table>
</div>