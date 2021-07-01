<?php include('../templates/header.html');   
session_start();
if (isset($_SESSION['rut'])){
    if(isset($_SESSION['jefe'])){
        include('../templates/body_postlogin_jefe.html');
    } else {
        include('../templates/body_postlogin.html');
    }   
} else {
    include('../templates/body_prelogin.html');
}
?>


<form class="row g-4 needs-validation justify-content-center" name="form1" id="signin-form" novalidate>
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
    <button class="btn btn-primary" type="submit">Iniciar Sesion</button>
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
 
include('config.php');
session_start();
 
if (isset($_POST['login'])) {   
 
    $username = $_POST['rut'];
    $password = $_POST['password'];
    
    $query = "SELECT login($username, $password)";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();
 
    if (!$result) {
        echo '<p class="error">Error en la combinacion de rut y contraseña</p>';
    } else {
        $_SESSION['rut'] = $username;
        echo '<p class="success">Sesion iniciada</p>';
    }
}
 
?>