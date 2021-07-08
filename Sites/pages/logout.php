<?php
session_start();
echo "<body style='background-color:#E6EAEB'>";
if (isset($_SESSION['rut'])){
    if(isset($_SESSION['jefe'])){
        unset($_SESSION['jefe']);
    } elseif(isset($_SESSION['trabajador'])) {
    	unset($_SESSION['trabajador']);
    };
    unset($_SESSION['rut']);
};
header("Location: ../index.php");

?>