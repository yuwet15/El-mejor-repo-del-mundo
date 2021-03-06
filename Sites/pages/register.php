<?php 
session_start();

if (isset($_SESSION['rut'])){
  header("Location: ../index.php");
} else {
  include('../templates/header.html');
  include('../templates/body_prelogin.html');
}
?>


<form class="row g-4 needs-validation justify-content-center" name="form1" id="signin-form" method="post" action="register_redirect.php" novalidate>
  <div><h2>Registrarse</div>
  <!-- Input nombre apellido -->
  <div class="row g-4 justify-content-center">
    <div class="col-md-5 form-floating">
      <input type="text" class="form-control" id="nombre_completo" name="nombre" placeholder="Nombre Apellido" 
      <?php
        if(isset($_SESSION['nombre_r'])){
          echo 'value="' . $_SESSION['nombre_r'] . '"';
          unset($_SESSION['nombre_r']);
        }
      ?>
       required>
      <label for="nombre_completo" class="form-label">Nombre Completo</label>

      <div class="invalid-feedback" id = "invalido">
        Campo requerido
      </div>
    </div>

    <!-- Input rut -->
    <div class="col-md-3 form-floating">
      <input type="text" class="form-control" name="rut" id="rut" placeholder="12345678-9" onchange="formato(value)" onkeyup="formato(value)" pattern="[0-9-kK]{10}"
      <?php
        if(isset($_SESSION['rut_r'])){
          echo 'value="' . $_SESSION['rut_r'] . '"';
          unset($_SESSION['rut_r']);
        }
      ?>
       required>
      <label for="rut" class="form-label">Rut</label>
      
      <div class="invalid-feedback" id = "invalido">
        Campo requerido
      </div>
    </div>

    <!-- Input edad -->
    <div class="col-md-2 form-floating">
      <input type="number" class="form-control" name="edad" id="edad_" placeholder="18" min="1" max="100" 
      <?php
        if(isset($_SESSION['edad_r'])){
          echo 'value="' . $_SESSION['edad_r'] . '"';
          unset($_SESSION['edad_r']);
        }
      ?>
       required>
      <label for="edad_" class="form-label">Edad</label>
    </div>
  </div>

  <!-- Input sexo -->
  <div class="row g-4 justify-content-center">
    <div class="col-md-3">
      <select class="form-select form-select-lg" name="sexo" id="sexo" required>
        <?php
        if(isset($_SESSION['sexo_r'])){
          echo "<option disabled value=\"\">Sexo</option>";
          $sexo = $_SESSION['sexo_r'];
          if($sexo == "hombre"){
            echo "<option selected value=\"hombre\">Hombre</option>";
            echo "<option value=\"mujer\">Mujer</option>";
          }else{
            echo "<option value=\"hombre\">Hombre</option>";
            echo "<option selected value=\"mujer\">Mujer</option>";
          }
          unset($_SESSION['sexo_r']);
        }else{
          echo "<option selected disabled value=\"\">Sexo</option>";
          echo "<option value=\"hombre\">Hombre</option>";
          echo "<option value=\"mujer\">Mujer</option>";
        }
        ?>
      </select>
      <div class="invalid-feedback">
        Por favor seleccione
      </div>
    </div>

    <!-- Input direccion -->
    <div class="col-md-9 form-floating">
      <input type="text" class="form-control" name="direccion" id="direccion_" placeholder="Ingrese su direccion" 
      <?php
        if(isset($_SESSION['direccion_r'])){
          echo 'value="' . $_SESSION['direccion_r'] . '"';
          unset($_SESSION['direccion_r']);
        }
      ?>
       required>
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

</body>
