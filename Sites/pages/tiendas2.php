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
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" accordion-padding-y=>
        Mostrar los 3 productos mas baratos por categoría
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#mostrar_p">
      <div class="accordion-body">
        <div class="container">
          <div class="row">
            <div class="col">
              <h2 class="justify-content-center">Comestibles </h2>
              <table class="table table-hover table-striped">
            
                <thead>
                  <tr>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th>blabla</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr> 
                    <td>pr</td> 
                    <td>[2]</td> 
                    <td>$comuna</td> 
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <h2 class="justify-content-center">No Comestibles </h2>
              <table class="table table-hover table-striped">
  
                <thead>
                  <tr>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th>blabla</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr> 
                    <td>pr</td> 
                    <td>[2]</td> 
                    <td>$comuna</td> 
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
       
      </div>
    </div>

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


