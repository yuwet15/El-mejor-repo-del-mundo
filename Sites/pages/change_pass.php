<?php 
session_start();
if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}
?>


<form class="row g-4 needs-validation justify-content-center" name="form1" id="signin-form" method="post" action="change_pass_redirect.php" novalidate>
  <div><h2>Cambiar contraseña</div>
  <div class="row g-3 justify-content-center">
    <div class="col-auto">
      <label for="inputPassword6" class="col-form-label">Clave actual</label>
    </div>
    <div class="col-auto">
      <input type="password" name="actual_pass"  id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" required>
    </div>
  </div>
  <div class="row g-3 justify-content-center">
    <div class="col-auto">
      <label for="inputPassword6" class="col-form-label">Nueva Clave</label>
    </div>
    <div class="col-auto">
      <input type="password" name="new_pass"  id="new_pass" class="form-control" aria-describedby="passwordHelpInline" required>
    </div>
  </div>
  <div class="row g-3 justify-content-center">
    <div class="col-auto">
      <label for="inputPassword6" class="col-form-label">Confirme Clave</label>
    </div>
    <div class="col-auto">
      <input type="password" name="confirm_pass"  id="confirm_pass" class="form-control" aria-describedby="passwordHelpInline" onkeyup="check()" required>
      <span id='message'></span>
    </div>
  </div>


  <?php
    if (isset($_SESSION['pass_dist'])){
      echo '<p class="error">Contraseñas no son iguales</p>';
      unset($_SESSION['pass_dist']);
    } elseif (isset($_SESSION['pass_inc'])) {
      echo '<p class="error">Contraseña actual incorrecta</p>';
      unset($_SESSION['pass_inc']);
    } elseif (isset($_SESSION['success'])) {
      echo '<p>Contraseña cambiada correctamente</p>';
      unset($_SESSION['success']);
    }
  ?>
  
  <div class="col-12 text-center">
    <button class="btn btn-primary" name="login" value="login" type="submit">Cambiar Contraseña</button>
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


