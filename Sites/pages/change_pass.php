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
  <div><h2>Cambiar contraseña</div>
  <div class="row g-3 align-items-center form-floating">
    <div class="col-auto">
      <input type="text" class="form-control" id="inputPassword6" placeholder="" onchange="formato(value)" onkeyup="formato(value)" maxlength="15" aria-describedby="passwordHelpInline" required>
      <label for="inputPassword6" class="col-form-label">Clave actual</label>
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


