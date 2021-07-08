<?php
session_start();
require("../config/conexion.php");

if (isset($_SESSION['rut'])){
  $rut = $_SESSION['rut'];
} else {
  header("Location: ../index.php");
}

if (isset($_POST['remover'])) {
	$query = "SELECT DISTINCT t.nombre, p.nombre, c.cantidad, (c.cantidad * p.precio), t.tienda_id, p.producto_id
    	FROM tiendas as t, productos as p, carrito as c
    	WHERE t.tienda_id = c.tienda_id AND c.rut = '$rut' AND p.producto_id = c.producto_id
    	ORDER BY t.nombre";

	$result = $db -> prepare($query);
	$result -> execute();
	$carrito = $result -> fetchAll();
	$aux = 1;
	foreach ($carrito as $producto) {
		$num = 'n_'.$aux;
		$aux = $aux + 1;
		$cantidad = $_POST[$num];
		if($cantidad){
  		if(intval($producto[2])>$cantidad){
  			$nuevo = intval($producto[2])-$cantidad;
  			$query = "UPDATE carrito SET cantidad=$nuevo 
  								WHERE rut='$rut' AND tienda_id=$producto[4] AND producto_id=$producto[5]";
  		}else{
  			$query = "DELETE FROM carrito WHERE rut='$rut' AND tienda_id=$producto[4] AND producto_id=$producto[5]";
  		}
	    $result = $db -> prepare($query);
	    $result -> execute();
	  }
	}
} 

header("Location: carrito.php");


?>