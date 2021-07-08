<?php
session_start();
include('../config/conexion.php');

 
if (isset($_POST['comprar'])) {  
    $rut = $_SESSION['rut'];     
    $direccion = $_POST['direccion'];
    $query = "SELECT DISTINCT tienda_id FROM carrito WHERE rut='$rut'";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();
    if (!$result[0][0]) {
        $_SESSION['nada'] = TRUE;
        header("Location: carrito.php");
    } else{
        foreach ($result as $tiendas) {
            $query = "SELECT comprar('$rut', $tiendas[0], $direccion)"; 
            $result = $db -> prepare($query);
            $result -> execute();
        }
        header("Location: ../index.php");
        
    }
}
 
?>