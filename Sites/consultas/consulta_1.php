<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario

  #Se construye la consulta como un string
 	$query = "SELECT DISTINCT t.nombre, d.Comuna_Despacho FROM Tiendas as t JOIN Despachos as d ON t.tiendas_id = d.tiendas_id;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$comunas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre de tienda</th>
      <th>Comuna</th>
    </tr>
  
      <?php
        foreach ($comunas as $c) {
          echo "<tr><td>$c[0]</td><td>$c[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
