<?php 
session_start();


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

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>


<div class="center">
  <div class="accordion accordion-flush" id="mostrar_p">
  <div class="accordion-item" style="background-color:#dce1e3">
    <h2 class="accordion-header" id="headingOne">
      <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
        Mostrar los tres productos mas baratos por categor??a
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
                    <th>Descripci??n</th>
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
                    <th>Descripci??n</th>
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
    FROM catalogo as c, productos as p
    WHERE c.tienda_id=$id  AND c.producto_id=p.producto_id
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
            <th>ID Producto</th>
            <th>Nombre</th>
            <th>Descripci??n</th>
            <th>Categor??a</th>
            </tr>
          </thead>
        
          <tbody>";
            foreach ($productos as $p) {
              $name = ucfirst($p[0]);
              $des = ucfirst($p[1]);
              echo "<tr> 
                      <td style=\"width:15%;\">$p[3]</td>
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
<form class="row g-4 needs-validation justify-content-center" name="form" id="form" method="post" action="" novalidate>
  <div class='row g-4 justify-content-center'>
    <div class='col-auto' style="text-align:center">
      ID del producto:
    </div>
    <div class='col-md-4' style="text-align: center;">
      <input class="form-control" type="number" name="id_producto" min="0" required>
    </div>
    <div class='col-auto' style="text-align:center">
      Cantidad: 
    </div>
    <div class='col-md-4' style="text-align:center">
      <input class="form-control" type="number" name="cantidad" min="1" required>
    </div>
    <div class='col-auto' style="text-align:center">
      Direccion despacho:
    </div>
    <div class='col-md-4' style="text-align:center">
      <?php

        $query = "SELECT DISTINCT c.direccion, c.direccion_id
                  FROM direcciones AS d, usuarios as u, comunas as c, despachos as des
                  WHERE u.usuario_id = d.usuario_id
                  AND d.direccion_id = c.direccion_id
                  AND des.comuna_despacho = c.comuna
                  AND des.tienda_id = $id
                  AND u.rut = '".$_SESSION['rut']."'";

        $result = $db -> prepare($query);
        $result -> execute();
        $user_address = $result -> fetchAll();
        if(!$user_address[0][0]){
          echo "<select class=\"form-select form-select-sm mb-3\" name=\"direccion\" id=\"direccion\" disabled>";
        }else{
          echo "<select class=\"form-select form-select-sm mb-3\" name=\"direccion\" id=\"direccion\" required>";
        }
        echo "<option disabled selected value=\"\">Seleccione direccion de despacho</option>";
        foreach ($user_address as $direccion) {
          echo "<option value=\"$direccion[1]\">$direccion[0]</option>";
        }
      ?>
      </select>
    </div>
    <div class='col-auto' style="text-align:center">
      <button class="btn btn-primary" name="carro_i" value="carro_i" type="submit">A??adir al carrito</button>
    </div>
  </div>
</form>
<br>
</div>
<?php
  if (isset($_POST['carro_i'])){
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $direccion = $_POST['direccion'];
    unset($_POST['id_producto']);
    unset($_POST['cantidad']);
    unset($_POST['direccion']);
    
    if($direccion == ""){
      echo "No existe cobertura de despacho";
    }else{
      $query = "SELECT * FROM catalogo 
                WHERE tienda_id=$id AND producto_id=$id_producto";
      $result = $db -> prepare($query);
      $result -> execute();
      $verificacion = $result -> fetchAll();

      if ($verificacion[0][0] || $verificacion[0][1]) {
        $query = "SELECT cantidad, rut FROM carrito 
                  WHERE rut='$rut_session' AND tienda_id=$id AND producto_id=$id_producto AND direccion_id = $direccion";
        $result = $db -> prepare($query);
        $result -> execute();
    
        $result = $result -> fetchAll();
        if(!$result[0][1]){
          $query = "INSERT INTO carrito
                    SELECT '$rut_session', $id, $id_producto, $cantidad, $direccion";
          $result = $db -> prepare($query);
          $result -> execute();
        }else{
          echo("2");
          $nueva_cant = $cantidad + $result[0][0];
          $query = "UPDATE carrito
                    SET cantidad = $nueva_cant
                    WHERE rut='$rut_session' AND tienda_id=$id AND producto_id=$id_producto";
          $result = $db -> prepare($query);
          $result -> execute();
        }
        echo"
        <div class=\"alert alert-success d-flex align-items-center\" role=\"alert\">
          <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\"><use xlink:href=\"#check-circle-fill\"/></svg>
          <div>
            Agregado exitosamente al carrito
          </div>
          <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>
        ";
      } else {
        echo"
        <div class=\"alert alert-primary d-flex align-items-center\" role=\"alert\">
          <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Info:\"><use xlink:href=\"#info-fill\"/></svg>
          <div>
            Esta tienda no cuenta con este producto actualmente
          </div>
          <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>";
      }
    }
  }
?>

<script type="text/javascript">
  (function () {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
</body>