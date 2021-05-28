<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = $_POST["comuna"];

  #Se construye la consulta como un string
  $query = "SELECT DISTINCT p.Nombre 
  FROM Personal as p JOIN Tiendas as t ON p.Tienda_id = t.Tienda_id JOIN Comunas as c ON t.Direccion_id = c.Direccion_id
  WHERE Comuna = $comuna;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db -> prepare($query);
  $result -> execute();
  $filas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre de jefes</th>
    </tr>
  
      <?php
        foreach ($filas as $f) {
          echo "<tr><td>$f[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>