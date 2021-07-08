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
    return strtotime($b['4']) - strtotime($a['4']);
}




$query = "SELECT c.compra_id, c.tienda_id, t.nombre, co.direccion
          FROM usuarios AS u, compras AS c, tiendas as t, comunas as co
          WHERE u.usuario_id = c.usuario_id
          AND u.rut = '".$_SESSION['rut']."'
          AND t.tienda_id = c.tienda_id
          AND co.direccion_id = c.direccion_id";

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
  array_push($id_compras[$counter], $fecha[0][0]);
  $counter = $counter + 1;
}
usort($id_compras, "date_sort");

$counter = 0;
foreach ($id_compras as $i) {
  $query = "SELECT sum(d.cantidad * p.precio)
            FROM detalle as d, productos as p
            WHERE d.compra_id = $i[0] 
            AND d.producto_id = p.producto_id";

  $result = $db -> prepare($query);
  $result -> execute();
  $suma = $result -> fetchAll();
  array_push($id_compras[$counter], $suma[0][0]);
  $counter = $counter + 1;
}

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
            echo "<tr> 
                    <td>$d[0]</td> 
                    <td>$d[5]</td> 
                    <td><a href='tiendas2.php?id={$d[1]}'></a>$d[2]</td>
                    <td>$d[3]</td> 
                    <td>$d[4]</td> 
                  </tr>";
          };
          ?>
      </tbody>
  </table>
</div>
</body>