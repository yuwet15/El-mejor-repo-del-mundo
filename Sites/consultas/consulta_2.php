<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = $_POST["comuna"];

  #Se construye la consulta como un string
  $query = "SELECT DISTINCT p.Nombre 
  FROM Personal as p, Tiendas as t, Comunas as c
  WHERE p.Tienda_id = t.Tienda_id AND t.direccion_id = c.Direccion_id AND p.Cargo LIKE '%Jefe%' AND c.Comuna LIKE '%$comuna%';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db -> prepare($query);
  $result -> execute();
  $filas = $result -> fetchAll();
  ?>
  <center>
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
  </center>
<?php include('../templates/footer.html'); ?>