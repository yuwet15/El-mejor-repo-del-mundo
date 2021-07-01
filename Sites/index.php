<?php include('templates/header.html');
session_start();

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