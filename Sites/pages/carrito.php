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
$query = "SELECT DISTINCT t.nombre, p.nombre, p.precio, c.cantidad, (c.cantidad * p.precio), t.tienda_id, p.producto_id, co.direccion
        	FROM tiendas as t, productos as p, carrito as c, comunas as co
        	WHERE t.tienda_id = c.tienda_id AND c.rut = '$rut' AND p.producto_id = c.producto_id AND c.direccion_id = co.direccion_id
        	ORDER BY t.nombre";

$result = $db -> prepare($query);
$result -> execute();
$carrito = $result -> fetchAll();


?>

<br>
<div class="container" style="background-color:#dce1e3">
	<form class="form-inline justify-content-center" method="post" action="remover_redirect.php">

	  <table class="table"	>
	  
		  <thead>
		    <tr>
		    <th>Tienda</th>
		    <th>Producto</th>
		    <th>Precio</th>
		    <th>Cantidad</th>
		    <th>Quitar</th>
		    <th>Valor</th>
		    <th>Direccion despacho</th>
		    </tr>
		  </thead>
		  
		  <tbody>
			 
				<?php
				$aux = 1;
				$Costo_total = 0;
				foreach ($carrito as $producto) {
					$Costo_total = $Costo_total + intval($producto[4]);
					$num = 'n_'.$aux;
					$aux = $aux + 1;
					echo "
					<tr>
					<td>$producto[0]</td> 
					<td>$producto[1]</td> 
		      		<td style=\"width:10%;\">$producto[2]</td>
		      		<td style=\"width:10%;\">$producto[3]</td>
		      		<td style=\"width:15%;\">
			          		<div class=\"input-group\">
			            		<input type=\"number\" name=\"$num\" id=\"$num\" min=\"0\" max=\"$producto[3]\" class=\"numDays form-control\">
			            		<span class=\"input-group-btn\">
			          			<button type=\"submit\" name=\"remover\" value=\"remover\" class=\"btn\" id=\"$name\"><img src=\"../icons/delete.svg\" alt=\"\" width=\"30\" height=\"24\" class=\"d-inline-block align-text-center\"></button>
			          			</span>
			          		</div>
			          	
		      		</td>
		      		<td>$producto[4]</td>
		      		<td>$producto[7]</td>
		      		</tr>";
				}
				
	      ?>
		  
		  </tbody>
		</table>
	</form>
	
	<form class="row g-4 needs-validation justify-content-center" name="form1" id="compra_form" method="post" action="compra_redirect.php" novalidate>
		<div class="row g-4 justify-content-center">
	  	<div class="col-md-3">
	  		<?php echo '<a> Valor total:'.$Costo_total.'</a>'?>
	  	</div>
	  	<div class="col-md-3 form-floating">
	  		<button class="btn btn-outline-secondary" name="comprar" id="comprar" type="submit" role="button">Comprar</button>
	  	</div>
	  	
	  </div>
  </form>
  <?php
  if (isset($_SESSION['nada'])){
  	echo '<p class="error">No compraste nada</p>';
    unset($_SESSION['nada']);
  }
  ?>
</div>

</body>