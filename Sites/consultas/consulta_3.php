<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $tipo = $_POST["tipo"];

  #Se construye la consulta como un string
  $query = "SELECT DISTINCT t.Nombre
  FROM Tiendas as t, Catalogo as c, Productos as p
  WHERE t.tienda_id = c.tienda_id AND c.producto_id = p.producto_id AND p.tipo = $tipo;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db -> prepare($query);
  $result -> execute();
  $filas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre de tiendas</th>
    </tr>
  
      <?php
        foreach ($filas as $f) {
          echo "<tr><td>$f[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>