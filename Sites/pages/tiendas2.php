<?php 
session_start();
if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}
?>

<form class="row g-4 justify-content-center" name="form" id="form" method="post" action="">
  <div class='col-auto' style="text-align:center">
    <br>
    Mostrar los 3 productos mas baratos por categoría
    <input type="submit" value="Mostrar">
  </div>
</form>

<form class="row g-4 justify-content-center" name="form" id="form" method="post" action="">
  Nombre del producto:
  <input type="text" name="nombre">
  <input type="submit" value="Buscar">
</form>
