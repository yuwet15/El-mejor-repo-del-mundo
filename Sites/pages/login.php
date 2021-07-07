<?php
session_start();
if (isset($_SESSION['rut'])){
    header("Location: ../index.php");
} else {
  include('../templates/header.html');
  include('../templates/body_prelogin.html');
}
?>


<form class="row g-4 needs-validation justify-content-center" name="form1" id="signin-form" method="post" action="login_redirect.php" novalidate>
  <div><h2>Iniciar Sesion</div>
  <?php
  if(isset($_SESSION['register'])){
    echo '<p>Su clave por defecto son los ultimos 4 digitos antes del verificador</p>';
    unset($_SESSION['register']);
  }
  ?>
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

  <?php
    if (isset($_SESSION['pass_inc'])){
      echo '<p class="error">Error en la combinacion de rut y contraseña</p>';
      unset($_SESSION['pass_inc']);
    } elseif (isset($_SESSION['no_user'])) {
      echo '<p class="error">No existe usuario ingresado</p>';
      unset($_SESSION['no_user']);
    }
  ?>
  
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


