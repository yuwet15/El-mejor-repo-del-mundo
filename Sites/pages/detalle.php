<?php 
session_start();

if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  require("../config/conexion.php");
  $_SESSION['previous_location'] = 'detalle.php?id='.$id;
  $query = "SELECT t.tienda_id FROM tiendas as t WHERE t.tienda_id=$id";
  $result = $db -> prepare($query);
  $result -> execute();
  $r = $result -> fetchAll();

  if ($r[0][0] != $id) {
    header("Location: ../index.php");
  }
}


if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}
$rut = $_SESSION['rut'];
?>
<br>
<h2 style="text-align: center;">Detalle de compra ID: <?php echo($id);?></h2>
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
                    <td><a href='detalle.php?id={$d[0]}'>$d[0]</a></td> 
                    <td>$d[5]</td> 
                    <td><a href='tiendas2.php?id={$d[1]}'>$d[2]</a></td>
                    <td>$d[3]</td> 
                    <td>$d[4]</td> 
                  </tr>";
          };
          ?>
      </tbody>
  </table>
</div>
</body>
