<?php 
session_start();
if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}
$rut = $_SESSION['rut'];

require("../config/conexion.php");
$query = "SELECT DISTINCT t.nombre, p.nombre, c.cantidad, (c.cantidad * p.precio), t.tienda_id, p.producto_id
        	FROM tiendas as t, productos as p, carrito as c
        	WHERE t.tienda_id = c.tienda_id AND c.rut = '$rut' AND p.producto_id = c.producto_id
        	ORDER BY t.nombre";

$result = $db -> prepare($query);
$result -> execute();
$carrito = $result -> fetchAll();


?>


<div class="container">
  <table class="table">
  
	  <thead>
	    <tr>
	    <th>Tienda</th>
	    <th>Producto</th>
	    <th>Cantidad</th>
	    <th>Quitar</th>
	    <th>Valor</th>
	    </tr>
	  </thead>
	  
	  <tbody>
		<tr> 
			<?php
			foreach ($carrito as $producto) {
				$name = $producto[4]."-".$producto[5];
				$num = $producto[5]."-".$producto[4];
				echo "
				<td>$producto[0]</td> 
				<td>$producto[1]</td> 
	      <td style=\"width:10%;\">$producto[2]</td>
	      <td style=\"width:15%;\">
	      	<form class=\"form-inline justify-content-center\" method=\"post\">
	          <div class=\"input-group\">
	            <input type=\"number\" name=\"$num\" id=\"$num\" min=\"0\" max=\"$producto[2]\" class=\"numDays form-control\">
	            <span class=\"input-group-btn\">
	          		<button type=\"submit\" name=\"$name\" value=\"$name\" class=\"btn\" id=\"$name\"><img src=\"../icons/delete.svg\" alt=\"\" width=\"30\" height=\"24\" class=\"d-inline-block align-text-center\"></button>
	          	</span>
	          </div>
	        </form>";
	        if (isset($_POST[$name])) {
	        	$cantidad = $_POST[$num];
	        	if($producto[3]!=$cantidad){
	        		$nuevo = $producto[3]-$cantidad;
	        		$query = "UPDATE carrito SET cantidad=$nuevo 
	        							WHERE rut='$producto[0]' AND tienda_id='$producto[4]' AND producto_id=$producto[5]";
					    $result = $db -> prepare($query);
					    $result -> execute();
	        	}
	        }   


	   		echo "
	      </td>
	      <td>$producto[3]</tr>";
			}
			
      ?>
	  </tr>
	  </tbody>
	</table>
	<div class="d-grid gap-2 col-2 mx-auto">
  	<a class="btn btn-outline-secondary" type="submit" role="button">Comprar</a>
	</div>

</div>