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
$query = "SELECT DISTINCT t.nombre, p.nombre, p.precio, c.cantidad, (c.cantidad * p.precio), t.tienda_id, p.producto_id
        	FROM tiendas as t, productos as p, carrito as c
        	WHERE t.tienda_id = c.tienda_id AND c.rut = '$rut' AND p.producto_id = c.producto_id
        	ORDER BY t.nombre";

$result = $db -> prepare($query);
$result -> execute();
$carrito = $result -> fetchAll();


?>

<br>
<div class="container" style="background-color:#dce1e3">
	<form class="form-inline justify-content-center" method="post">

	  <table class="table">
	  
		  <thead>
		    <tr>
		    <th>Tienda</th>
		    <th>Producto</th>
		    <th>Precio</th>
		    <th>Cantidad</th>
		    <th>Quitar</th>
		    <th>Valor</th>
		    </tr>
		  </thead>
		  
		  <tbody>
			<tr> 
				<?php
				$aux = 1;
				$Costo_total = 0;
				foreach ($carrito as $producto) {
					$Costo_total = $Costo_total + intval($producto[4]);
					$num = 'n_'.$aux;
					$aux = $aux + 1;
					echo "
					<td>$producto[0]</td> 
					<td>$producto[1]</td> 
		      <td style=\"width:10%;\">$producto[2]</td>
		      <td style=\"width:10%;\">$producto[3]</td>
		      <td style=\"width:15%;\">
		      	<form class=\"form-inline justify-content-center\" method=\"post\">
		          <div class=\"input-group\">
		            <input type=\"number\" name=\"$num\" id=\"$num\" min=\"0\" max=\"$producto[3]\" class=\"numDays form-control\">
		            <span class=\"input-group-btn\">
		          		<button type=\"submit\" name=\"remover\" value=\"remover\" class=\"btn\" id=\"$name\"><img src=\"../icons/delete.svg\" alt=\"\" width=\"30\" height=\"24\" class=\"d-inline-block align-text-center\"></button>
		          	</span>
		          </div>
		      </td>
		      <td>$producto[4]</tr>";
				}
				
	      ?>
		  </tr>
		  </tbody>
		</table>
	</form>
	<?php
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
	  		if(intval($producto[2])!=$cantidad){
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
  } ?>
	<form class="row g-4 needs-validation justify-content-center" name="form1" id="compra_form" method="post" action="compra_redirect.php" novalidate>
		<div class="row g-4 justify-content-center">
    	<div class="col-md-3">
				<select class="form-select form-select-sm mb-3" name="direccion" id="direccion" required>
					<option selected value="NULL">Retiro en tienda</option>";
		      <?php

		      $query = "SELECT DISTINCT c.direccion, c.direccion_id
					          FROM direcciones AS d, usuarios as u, comunas as c
					          WHERE u.usuario_id = d.usuario_id
					          AND d.direccion_id = c.direccion_id
					          AND u.rut = '".$_SESSION['rut']."'";

					$result = $db -> prepare($query);
					$result -> execute();
					$user_address = $result -> fetchAll();

					foreach ($user_address as $direccion) {
						echo "<option value=\"$direccion[1]\">$direccion[0]</option>";
					}
		       ?>
	      </select>
	  	</div>
	  	<div class="col-md-3 form-floating">
	  		<a class="btn btn-outline-secondary" type="submit" role="button">Comprar</a>
	  	</div>
	  	<div class="col-md-3 form-floating">
	  		<?php echo '<a> Valor total:'.$Costo_total.'</a>'?>
	  	</div>
	  </div>
  </form>
  <?php
  if (isset($_SESSION['nada'])){
  	echo '<p class="error">No compraste nada</p>';
    unset($_SESSION['nada']);
  } elseif (isset($_SESSION['success'])){
  	unset($_SESSION['success']);
  	echo "<p> Compra realizada sastifactoriamente</p>";
  }
  ?>
</div>