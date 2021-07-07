<?php 
session_start();
  
if (isset($_SESSION['rut'])){
	include('../templates/header.html'); 
    include('../templates/body_postlogin.html');
} else {
	header("Location: ../index.php");
}
?>
