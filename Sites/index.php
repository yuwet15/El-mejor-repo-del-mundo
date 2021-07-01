<?php 
session_start();
include('templates/header.html');

if (isset($_SESSION['rut'])){
	if(isset($_SESSION['jefe'])){
		include('templates/body_postlogin_jefe.html');
	} else {
		include('templates/body_postlogin.html');
	}	
} else {
	include('templates/body_prelogin.html');
}
?>

Home



    

    
</body>
</html>