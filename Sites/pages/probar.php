<?php 
session_start();

if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}?>
<form class="row g-4 needs-validation justify-content-center" name="form1"  method="post" action="" novalidate>
	<input type="text" class="form-control" name="rut" id="rut" placeholder="12345678-9" onchange="formato(value)" onkeyup="formato(value)" maxlength="10" required>
	<div class="col-12 text-center">
	    <button class="btn btn-primary" name="login" value="login" type="submit">Iniciar Sesion</button>
	  </div>
</form> 
<?php
if (isset($_POST['login'])) {   
    //session_start();
    
    $query = $_POST['rut'];
    $result = $db -> prepare("$query");
    $result -> execute();
 
    $result = $result -> fetchAll();
    foreach ($result as $r) {
    	foreach ($r as $k) {
    		echo($k);
    	}
    }
}
?>