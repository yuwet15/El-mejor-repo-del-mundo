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
if (isset($_GET['id'])) {
?>

<form class="row g-4 justify-content-center" name="form" id="form" method="post" action="">
  <div class='row g-4 justify-content-center'>
    <div class='col-auto' style="text-align:center">
      <br>
      <!-- &nbsp; es un espacio -->
      Mostrar los 3 productos mas baratos por categoría&nbsp;
      <input type="submit" value="Mostrar">
    </div>
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
}

<?php 
else {
  header('Location: ../../index.php');
}
?>

<?php 
  $id = $_GET['id']
  echo $id
?>


