<?php 
session_start();
include('../templates/header.html');   
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


<form class="row g-4 needs-validation justify-content-center" name="form1" id="signin-form" method="post" action="" novalidate>
  <div><h2>Registrarse</div>
  <div class="row g-4 justify-content-center">
    <div class="col-md-5 form-floating">
      <input type="text" class="form-control" id="nombre_completo" name="nombre" placeholder="Nombre Apellido" required>
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
      <select class="form-select form-select-lg" id="sexo" required>
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


<?php
 
include('../config/conexion.php');

if (isset($_POST['register'])) {   
    
    $nombre = $_POST['nombre'];
    $rut = $_POST['rut'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $direccion = $_POST['direccion'];


    $query = "SELECT register($nombre, $rut, $edad, $sexo, $direccion)";
    $result = $db -> prepare($query);
    $result -> execute();

    $result = $result -> fetchAll();
    echo "$result";
    if (!$result) {
        echo 'Username password combination is wrong!';
    } else {
        if (password_verify($password, $result['PASSWORD'])) {
            $_SESSION['user_id'] = $result['ID'];
            echo 'Congratulations, you are logged in!';
        } else {
            echo 'Username password combination is wrong!';
        }
    }
}
 
?>