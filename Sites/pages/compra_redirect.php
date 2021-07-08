<?php
session_start();
include('../config/conexion.php');

 
if (isset($_POST['comprar'])) {  
    $rut = $_SESSION['rut'];     
    $query = "SELECT DISTINCT tienda_id, direccion_id FROM carrito WHERE rut='$rut'";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();

    $query = "SELECT cantidad FROM carrito WHERE rut='$rut'";
    $veri = $db -> prepare($query);
    $veri -> execute();
 
    $veri = $veri -> fetchAll();
    if (!$veri[0][0]) {
        $_SESSION['nada'] = TRUE;
        header("Location: carrito.php");
    } else{
        foreach ($result as $tiendas) {
            $direccion = intval($tiendas[1]);
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
            $query = "INSERT INTO despachos (id, fecha, destino, compra_id) VALUES ($id_despacho, CURRENT_TIMESTAMP(0), $direccion, $id_compra)";
            $result = $db2 -> prepare($query);
            $result -> execute();

        }
        header("Location: ../index.php");
        
    }
}
 
?>