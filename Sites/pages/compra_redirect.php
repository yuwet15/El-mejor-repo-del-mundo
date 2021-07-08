<?php
session_start();
include('../config/conexion.php');

 
if (isset($_POST['comprar'])) {  
    $rut = $_SESSION['rut'];     
    $direccion = $_POST['direccion'];
    $query = "SELECT tienda_id, cantidad FROM carrito WHERE rut='$rut'";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();
    if (!$result[0][1]) {
        $_SESSION['nada'] = TRUE;
        header("Location: carrito.php");
    } else{
        foreach ($result as $tiendas) {
            $query = "SELECT comprar('$rut', $tiendas[0], $direccion)"; 
            $result = $db -> prepare($query);
            $result -> execute();

            $id_compra = $result -> fetchAll();
            $id_compra = intval($id_compra[0][0]);
            $direccion = intval($direccion);
            $query = "SELECT max(id) FROM despachos"; 
            $result = $db2 -> prepare($query);
            $result -> execute();

            $result = $result -> fetchAll();

            $id_despacho = intval($result[0][0]) + 1;
            $query = "INSERT INTO despachos (id, fecha, destino, compra_id) VALUES ($id_despacho, CURRENT_DATE, $direccion, $id_compra )";
            $result = $db2 -> prepare($query);
            $result -> execute();

        }
        header("Location: ../index.php");
        
    }
}
 
?>