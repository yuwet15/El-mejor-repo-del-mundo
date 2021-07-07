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
    <p >Mostrar los 3 productos mas baratos por categoría</p>
    <button type="button" class="btn btn-dark">Mostrar</button>
  </div>
</form>
