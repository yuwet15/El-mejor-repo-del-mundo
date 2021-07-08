<?php 
session_start();


if (isset($_SESSION['rut'])){
	include('../templates/header.html'); 
    include('../templates/body_postlogin.html');
} else {
	header("Location: ../index.php");
}

include('../config/conexion.php');

$product_id = $_GET['id'];
$product_id = intval($product_id);

$query = "SELECT p.tipo
          FROM productos AS p
          WHERE p.producto_id = $product_id";

$result = $db -> prepare($query);
$result -> execute();
$tipo = $result -> fetchAll();

if ($tipo[0][0] == 'Comestible') {

	$query = "SELECT categoria
            FROM comestibles
            WHERE producto_id = $product_id";

	$result = $db -> prepare($query);
	$result -> execute();
	$categoria = $result -> fetchAll();

	if ($categoria[0][0] == 'Congelado') {
	
		$query = "SELECT p.producto_id, p.nombre, p.precio, p.descripcion,
		          		 com.expiracion, com.categoria, con.peso
              FROM productos AS p, comestibles AS com, congelados AS con
              WHERE p.producto_id = com.producto_id
              AND p.producto_id = con.producto_id 
              AND p.producto_id = $product_id";

		$result = $db -> prepare($query);
		$result -> execute();
		$datos = $result -> fetchAll();
	
	} elseif ($categoria[0][0] == 'Conserva') {
	
		$query = "SELECT p.producto_id, p.nombre, p.precio, p.descripcion,
		                 com.expiracion, com.categoria, con.conserva
              FROM productos AS p, comestibles AS com, conserva AS con
              WHERE p.producto_id = com.producto_id
              AND p.producto_id = con.producto_id 
              AND p.producto_id = $product_id";
      
		$result = $db -> prepare($query);
		$result -> execute();
		$datos = $result -> fetchAll();

	} else {

		$query = "SELECT p.producto_id, p.nombre, p.precio, p.descripcion,
		                 c.expiracion, c.categoria, f.duracion
							FROM productos AS p, comestibles AS c, frescos AS f
							WHERE p.producto_id = c.producto_id
							AND p.producto_id = f.producto_id 
							AND p.producto_id = $product_id";
	
		$result = $db -> prepare($query);
		$result -> execute();
		$datos = $result -> fetchAll();
	}
} else {
	$query = "SELECT p.producto_id, p.nombre, p.precio, p.descripcion,
									 nc.alto, nc.ancho, nc.peso
						FROM productos AS p, nocomestibles AS nc
						WHERE p.producto_id = nc.producto_id
						AND p.producto_id = $product_id";

	$result = $db -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
}

?>

<table class="table">
  
  <thead>
    <tr>
    <th>ID Producto</th>
    <th>Nombre</th>
    <th>Precio $</th>
		<th>Descripción</th>
    
		<?php
    if ($tipo[0][0] == 'Comestible') {
      
			echo "<th>Fecha de expiración</th>
						<th>Categoría</th>";
			
			if ($categoria[0][0] == 'Congelado') {
				
				echo "<th>peso(kg)</th>";

			} elseif ($categoria[0][0] == 'Conserva') {
				
				echo "<th>Tipo de conserva</th>";

			} else {
				
				echo "<th>Días de duración</th>";

			}
    } else {
			
			echo "<th>alto(cm)</th>
						<th>ancho(cm)</th>
						<th>peso(kg)</th>";
		}
    ?>
    </tr>

  </thead>
  <tbody>
    <?php
      foreach ($datos as $d) {

				echo "<tr> <td>$d[0]</td> <td>$d[1]</td> <td>$d[2]</td> 
									 <td>$d[3]</td> <td>$d[4]</td> <td>$d[5]</td>
									 <td>$d[6]</td> </tr>";
      }
    ?>
  </tbody>
</table>


<div class="d-grid gap-2 col-6 mx-auto">
  <a class="btn btn-outline-secondary" href="back_redirect.php" role="button">Volver</a>
</div>

</body>