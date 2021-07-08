<?php 
session_start();

if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}?>
<form class="row g-4 needs-validation justify-content-center" name="form1"  method="post" action="" novalidate>
	<input type="text" class="form-control" name="rut" id="rut" required>
	<div class="col-12 text-center">
	    <button class="btn btn-primary" name="login" value="login" type="submit">Probar</button>
	  </div>
</form> 
<?php
if (isset($_POST['login'])) {   
    //session_start();
    
    $query = $_POST['rut'];
    echo($query);
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();
    foreach ($result as $r) {
    	foreach ($r as $k) {
    		echo($k);
    	}
    }
}
?>

<form class="row g-4 needs-validation justify-content-center" name="form1"  method="post" action="" novalidate>
	<input type="text" class="form-control" name="rut2" id="rut2" required>
	<div class="col-12 text-center">
	    <button class="btn btn-primary" name="login2" value="login2" type="submit">Probar</button>
	  </div>
</form> 
<?php
if (isset($_POST['login2'])) {   
    //session_start();
    
    $query = $_POST['rut2'];
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