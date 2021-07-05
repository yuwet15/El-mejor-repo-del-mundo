<?php
session_start();
include('../templates/header.html');
if (isset($_SESSION['rut'])){
    if(isset($_SESSION['jefe'])){
        include('../templates/body_postlogin_jefe.html');
    } else {
        include('../templates/body_postlogin_normal.html');
    }   
} else {
    include('../templates/body_prelogin.html');
}
?>


<form class="row g-4 needs-validation justify-content-center" name="form1" id="signin-form" method="post" action="" novalidate>
  <div><h2>Iniciar Sesion</div>
  <div class="row g-4 justify-content-center">
    <div class="col-md-3 form-floating">
      <input type="text" class="form-control" name="rut" id="rut" placeholder="12345678-9" onchange="formato(value)" onkeyup="formato(value)" maxlength="10" required>
      <label for="rut" class="form-label">Rut</label>
    </div>
    <div class="col-md-3 form-floating">
      <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
      <label for="rut" class="form-label">Contraseña</label>
    </div>
  </div>

  <div class="col-12 text-center">
    <button class="btn btn-primary" name="login" value="login" type="submit">Iniciar Sesion</button>
  </div>
</form> 

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

<?php
 
include('../config/conexion.php');

 
if (isset($_POST['login'])) {   
    //session_start();
    
    $username = $_POST['rut'];
    $password = $_POST['password'];
    echo '<p class="success">$username , $password Sesion iniciada</p>';
    $query = "SELECT login('$username', '$password')";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();
 
    if (!$result) {
        echo '<p class="error">Error en la combinacion de rut y contraseña</p>';
    } else {
        $_SESSION['rut'] = $username;
        //Falta comprobar si es o no jefe
        echo '<p class="success">Sesion iniciada</p>';
    }
}
 
?>