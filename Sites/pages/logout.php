<?php
session_start();
if (isset($_SESSION['rut'])){
    if(isset($_SESSION['jefe'])){
        unset($_SESSION['jefe']);
        unset($_SESSION['rut']);
        header("Location: ../index.php");
    } else {
        unset($_SESSION['rut']);
        header("Location: ../index.php");
    }   
} else {
	header("Location: ../index.php");
}
?>