<?php 
session_start();


if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  require("../config/conexion.php");
  $_SESSION['previous_location'] = 'tiendas2.php?id=$id';
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
?>

<div class="accordion accordion-flush" id="mostrar_p">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
        Mostrar los 3 productos mas baratos por categoría
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#mostrar_p">
      <div class="accordion-body">
        <div class="container">
          <div class="row">
            <div class="col">
              <h2 class="justify-content-center">Comestibles </h2>
              <table class="table table-hover table-striped">
            
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                  </tr>
                </thead>
                
                <?php
                  $query = "SELECT p.nombre, p.precio, p.descripcion, p.producto_id FROM tiendas as t, catalogo as c, productos as p
                  WHERE t.tienda_id=$id AND c.producto_id=p.producto_id AND c.tienda_id=t.tienda_id
                  AND p.tipo='Comestible'
                  ORDER BY p.precio LIMIT 3";

                  $result = $db -> prepare($query);
                  $result -> execute();
                  $productos = $result -> fetchAll();
                ?>

                <tbody>
                  <?php
                  foreach ($productos as $p)
             echo "<tr> 
                    <th><a href='productos.php?id={$p[3]}'>$p[0]</a></th>
                    <th>$p[1]</th>
                    <th>$p[2]</th>
                  </tr>"
                  ?>
                </tbody>
              </table>
            </div>
            <div class="col">
              <h2 class="justify-content-center">No Comestibles </h2>
              <table class="table table-hover table-striped">
  
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                  </tr>
                </thead>
                
                <?php
                  $query = "SELECT p.nombre, p.precio, p.descripcion, p.producto_id FROM tiendas as t, catalogo as c, productos as p
                  WHERE t.tienda_id=$id AND c.producto_id=p.producto_id AND c.tienda_id=t.tienda_id
                  AND p.tipo='NoComestible'
                  ORDER BY p.precio LIMIT 3";

                  $result = $db -> prepare($query);
                  $result -> execute();
                  $productos = $result -> fetchAll();
                ?>

                <tbody>
                  <?php
                  foreach ($productos as $p)
             echo "<tr> 
                    <th><a href='productos.php?id={$p[3]}'>$p[0]</th>
                    <th>$p[1]</th>
                    <th>$p[2]</th>
                  </tr>"
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
       
      </div>
    </div>
<?php

?>
<form class="row g-4 justify-content-center" name="form" id="form" method="post" action="">
  
  <div class='row g-4 justify-content-center'>
    <div class='col-auto' style="text-align:center">
    <br>
      Nombre del producto:
      <input type="text" name="nombre_producto">
      <button class="btn btn-primary" name="buscar_n" value="buscar_n" type="submit">Buscar</button>
      <button class="btn btn-primary" name="limpiar_n" value="limpiar_n" type="submit">Limpiar</button>
    </div>
  </div>
</form>
<?php
  if (isset($_POST['buscar_n'])){
    $nombre = $_POST['nombre_producto'];
    $query = "SELECT DISTINCT p.nombre, p.descripcion, p.tipo, p.producto_id
    FROM compras as c, detalle as d, productos as p
    WHERE c.tienda_id=$id AND c.compra_id=d.compra_id AND d.producto_id=p.producto_id
    AND LOWER(p.nombre) LIKE LOWER('%$nombre%')";

    $result = $db -> prepare($query);
    $result -> execute();
    $productos = $result -> fetchAll();

    if($productos[0][0]){
      echo"
      <div class=\"container\">
        <table class=\"table\">
        
          <thead>
            <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Categoría</th>
            </tr>
          </thead>
        
          <tbody>";
            foreach ($productos as $p) {
              $name = ucfirst($p[0]);
              $des = ucfirst($p[1]);
              echo "<tr> 
                      <td><a href='productos.php?id={$p[3]}'>$name</td> 
                      <td>$des</td> 
                      <td>$p[2]</td>
                    </tr>";
            }
    echo "</tbody>
        </table>
      </div>";
    }
  }elseif (isset($_POST['limpiar_n'])){
    echo "";
  }
?>
<form class="row g-4 justify-content-center" name="form" id="form" method="post" action="">
  <div class='row g-4 justify-content-center'>
    <div class='col-auto' style="text-align:center">
    <br>
      ID del producto:
      <input type="text" name="id_producto">
      <button class="btn btn-primary" name="buscar_i" value="buscar_i" type="submit">Buscar</button>
    </div>
  </div>
</form>
<?php
  if (isset($_POST['buscar_i'])){
    echo ($_POST['id_producto']) ;
  }
?>

