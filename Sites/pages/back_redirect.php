<?php
session_start();
echo "<body style='background-color:#E6EAEB'>";
include('../config/conexion.php');

 
if (isset($_SESSION['previous_location'])){
	$previous_location = $_SESSION['previous_location'];
	unset($_SESSION['previous_location']);
	header("Location: $previous_location");
} else{
	header("Location: ../index.php");
}