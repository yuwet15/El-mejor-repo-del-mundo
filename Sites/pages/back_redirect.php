<?php
session_start();
include('../config/conexion.php');

 
if (isset($_POST['previous_location'])){
	$previous_location = $_POST['previous_location'];
	unset($_POST['previous_location']);
	header("Location: $previous_location");
} else{
	header("Location: ../index.php");
}