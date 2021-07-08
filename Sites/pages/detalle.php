<?php 
session_start();

if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  require("../config/conexion.php");
  $_SESSION['previous_location'] = 'detalle.php?id='.$id;
  $query = "SELECT compra_id FROM detalle WHERE compra_id=$id";
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

$query = "SELECT d.producto_id, p.nombre, p.precio, d.cantidad, (p.precio * d.cantidad)
          FROM detalle as d, productos as p
          WHERE d.compra_id = $id
          AND d.producto_id = p.producto_id";

$result = $db -> prepare($query);
$result -> execute();
$detalles = $result -> fetchAll();




?>
<br>
<h2 style="text-align: center;">Detalle de compra ID: <?php echo($id);?></h2>
<div class="container" style="background-color:#dce1e3">
  <table class='table'>
      <thead>
          <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Valor</th>
          <th>Cantidad</th>
          <th>Valor total</th>
          </tr>
      </thead>
      <tbody>
          <?php
          foreach ($detalles as $d) {
            echo "<tr> 
                    <td>$d[0]</td> 
                    <td><a href='productos.php?id={$d[0]}'>$d[1]</a></td> 
                    <td>$d[2]</td>
                    <td>$d[3]</td> 
                    <td>$d[4]</td> 
                  </tr>";
          };
          ?>
      </tbody>
  </table>
</div>
</body>
