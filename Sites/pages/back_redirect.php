<?php
session_start();
include('../config/conexion.php');

 
if (isset($_SESSION['previous_location'])){
	$previous_location = $_SESSION['previous_location'];
	unset($_SESSIONT['previous_location']);
	header("Location: $previous_location");
} else{
	header("Location: ../index.php");
}