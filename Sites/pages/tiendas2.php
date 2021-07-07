<?php 
session_start();
if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  require("../config/conexion.php");

  $query = "SELECT t.tienda_id FROM tiendas as t WHERE t.tienda_id=$id";
  $result = $db -> prepare($query);
  $result -> execute();
  $r = $result -> fetchAll();

  if ($r[0][0] != $id) {
    echo $id;
    echo '\n';
    echo $r[0][0];
    header("Location: ../index.php");
  }
}

if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}
?>


<form class="row g-4 justify-content-center" name="form" id="form" method="post" action="">
  <div class='row g-4 justify-content-center'>
    <div class='col-auto' style="text-align:center">
      <br>
      <!-- &nbsp; es un espacio -->
      Mostrar los 3 productos mas baratos por categoría&nbsp;
      <input type="submit" value="Mostrar">
    </div>
    <?php
      $cat = ['Comestible', 'NoComestible'];
      foreach ($cat as $c) {
        echo "Productos {$c}s";
        $query = "SELECT p.nombre FROM tiendas as t, catalogo as c, productos as p
        WHERE t.tienda_id=$id AND c.producto_id=p.producto_id AND c.tienda_id=t.tienda_id
        AND p.tipo='$c'
        ORDER BY p.precio LIMIT 3";

        $result = $db -> prepare($query);
        $result -> execute();
        $productos = $result -> fetchAll();
        echo $productos[0][0];
      }
    ?>
  </div>
  
  <div class='row g-4 justify-content-center'>
    <div class='col-auto' style="text-align:center">
    <br>
      Nombre del producto:
      <input type="text" name="nombre">
      <input type="submit" value="Buscar">
    </div>
  </div>

  <div class='row g-4 justify-content-center'>
    <div class='col-auto' style="text-align:center">
    <br>
      ID del producto:
      <input type="text" name="id">
      <input type="submit" value="Buscar">
    </div>
  </div>
</form>
<?php 


