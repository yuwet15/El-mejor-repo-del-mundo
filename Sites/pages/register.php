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


<form class="row g-4 needs-validation justify-content-center" name="form1" id="signin-form" method="post" action="register_redirect.php" novalidate>
  <div><h2>Registrarse</div>
  <div class="row g-4 justify-content-center">
    <div class="col-md-5 form-floating">
      <?php
        echo "<input type=\"text\" class=\"form-control\" id=\"nombre_completo\" name=\"nombre\" placeholder=\"Nombre Apellido\" ";
        if(isset($_SESSION['nombre_r'])){
          $value = $_SESSION['nombre_r'];
          echo 'value="$value"';
        }
        echo " required>";
        echo($_SESSION['nombre_r']);
      ?>
      <label for="nombre_completo" class="form-label">Nombre Completo</label>

      <div class="invalid-feedback" id = "invalido">
        Campo requerido
      </div>
    </div>
    <div class="col-md-3 form-floating">
      <input type="text" class="form-control" name="rut" id="rut" placeholder="12345678-9" onchange="formato(value)" onkeyup="formato(value)" maxlength="10" required>
      <label for="rut" class="form-label">Rut</label>
      
      <div class="invalid-feedback" id = "invalido">
        Campo requerido
      </div>
    </div>
    <div class="col-md-2 form-floating">
      <input type="number" class="form-control" name="edad" id="edad_" placeholder="18" min="1" max="100" required>
      <label for="edad_" class="form-label">Edad</label>
    </div>
    
  </div>
  <div class="row g-4 justify-content-center">
    <div class="col-md-3">
      <select class="form-select form-select-lg" name="sexo" id="sexo" required>
        <option selected disabled value="">Sexo</option>
        <option value="M">Hombre</option>
        <option value="F">Mujer</option>
      </select>
      <div class="invalid-feedback">
        Por favor seleccione
      </div>
    </div>
    <div class="col-md-9 form-floating">
      <input type="text" class="form-control" name="direccion" id="direccion_" placeholder="Ingrese su direccion" required>
      <label for="direccion_" class="form-label">Direccion</label>
      <div class="invalid-feedback" id = "invalido">
          Campo requerido
      </div>
    </div>
  </div>
  <?php
    if (isset($_SESSION['rut_ext'])){
      echo '<p class="error">Rut ya registrado</p>';
      unset($_SESSION['rut_ext']);
    }elseif (isset($_SESSION['no_dic'])) {
      echo '<p class="error">Direccion ingresada no existente</p>';
      unset($_SESSION['no_dic']);
    }
  ?>
  <div class="col-12 text-center">
    <button class="btn btn-primary" type="submit" name="register" value="register">Registrar</button>
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

