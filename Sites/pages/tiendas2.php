<?php 
session_start();

echo "<body style='background-color:#DCE1E3'>";

if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  require("../config/conexion.php");
  $_SESSION['previous_location'] = 'tiendas2.php?id='.$id;
  $query = "SELECT t.tienda_id FROM tiendas as t WHERE t.tienda_id=$id";
  $result = $db -> prepare($query);
  $result -> execute();
  $r = $result -> fetchAll();

  if ($r[0][0] != $id) {
    header("Location: ../index.php");
  }
}

if (isset($_SESSION['rut'])){
  $rut_session = $_SESSION['rut'];
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}
?>

<div class="center">
  <br>
<div class="accordion accordion-flush" id="mostrar_p">
  <div class="accordion-item" style="background-color:#111">
    <h2 class="accordion-header" id="headingOne">
      <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
        Mostrar los tres productos mas baratos por categoría
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
      ID del producto:
    </div>
    <div class='col-md-4' style="text-align: center;">
      <input type="number" name="id_producto">
    </div>
    <div class='col-auto' style="text-align:center">
      Cantidad:
    </div>
    <div class='col-md-4' style="text-align:center">
      <input type="number" name="cantidad" min="1">
    </div>
    <div class='col-auto' style="text-align:center">
      <button class="btn btn-primary" name="buscar_i" value="buscar_i" type="submit">Añadir al carrito</button>
    </div>
  </div>
</form>
<br>
</div>
<?php
  if (isset($_POST['buscar_i'])){
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    unset($_POST['id_producto']);
    unset($_POST['cantidad']);
    $query = "SELECT cantidad, rut FROM carrito 
              WHERE rut='$rut_session' AND tienda_id=$id AND producto_id=$id_producto";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();
    if(!$result[0][1]){
      $query = "INSERT INTO carrito(rut, tienda_id, producto_id, cantidad)
                SELECT '$rut_session', $id, $id_producto, $cantidad";
      $result = $db -> prepare($query);
      $result -> execute();
    }else{
      $nueva_cant = $cantidad + $result[0][0];
      $query = "UPDATE carrito
                SET cantidad = $nueva_cant
                WHERE rut='$rut_session' AND tienda_id=$id AND producto_id=$id_producto";
      $result = $db -> prepare($query);
      $result -> execute();
    }
    echo "Agregado exitosamente al carrito";
  }
?>

