<?php
session_start();
if (isset($_SESSION['rut'])){
	unset($_SESSION['rut']);}
if(isset($_SESSION['jefe'])){
    unset($_SESSION['jefe']);}
if(isset($_SESSION['trabajador'])){
	unset($_SESSION['trabajador']);}
if(isset($_SESSION['J_tienda'])){
	unset($_SESSION['J_tienda']);}
if(isset($_SESSION['E_tienda'])){
	unset($_SESSION['E_tienda']);}
header("Location: ../index.php");

?>