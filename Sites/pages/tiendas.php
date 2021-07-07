<?php 
session_start();
if (isset($_SESSION['rut'])){
  include('../templates/header.html');
  include('../templates/body_postlogin.html');
} else {
  header("Location: ../index.php");
}
?>
<?php
require("../config/conexion.php");

$query = "SELECT t.tienda_id, t.nombre, c.direccion, c.comuna, p.nombre
        FROM tiendas as t, comunas as c, personal as p
        WHERE t.tienda_id = p.tienda_id AND  t.direccion_id = c.direccion_id
        ORDER BY t.tienda_id;";

$result = $db -> prepare($query);
$result -> execute();
$tiendas = $result -> fetchAll();
?>

<table class="table">
  
  <thead>
    <tr>
    <th>Nombre de tienda</th>
    <th>Direccion</th>
    <th>Comuna</th>
    <th>Jefe</th>
    </tr>
  </thead>
  
  <tbody>
    <?php
      foreach ($tiendas as $t) {
          echo "<tr> <td><a href='tiendas2.php?id={$t[0]}'>{$t[1]}</a></td> <td>$t[2]</td> <td>$t[3]</td> <td>$t[4]</td>";
      }
    ?>
  </tbody>
</table>


