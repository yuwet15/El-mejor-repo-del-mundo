<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario

  #Se construye la consulta como un string
 	$query = "SELECT DISTINCT t.nombre, d.Comuna_Despacho FROM Tiendas as t JOIN Despachos as d ON t.tienda_id = d.tienda_id ORDER BY t.nombre;";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$filas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre de tienda</th>
      <th>Comuna</th>
    </tr>
  
      <?php
        foreach ($filas as $f) {
          echo "<tr><td>$f[0]</td><td>$f[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
