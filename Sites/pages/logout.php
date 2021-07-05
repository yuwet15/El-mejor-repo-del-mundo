<?php
session_start();
include('../templates/header.html');
if (isset($_SESSION['rut'])){
    if(isset($_SESSION['jefe'])){
        unset($_SESSION['jefe']);
        unset($_SESSION['rut']);
        header("Location: ../index.php");
    } else {
        unset($_SESSION['rut']);
    }   
} else {
	header("Location: ../index.php");
}
?>