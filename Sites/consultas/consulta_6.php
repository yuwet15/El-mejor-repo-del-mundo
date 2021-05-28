<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $tipo = $_POST["tipo"];

  #Se construye la consulta como un string
  $query = "SELECT t.nombre, SUM(d.cantidad) as suma
  FROM Tiendas as t, Productos as p, detalle as d, Compras as c
  WHERE t.tienda_id = c.tienda_id AND c.compra_id = d.compra_id AND d.producto_id = p.producto_id AND p.tipo = '$tipo'
  GROUP BY t.nombre 
  ORDER BY suma DESC;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db -> prepare($query);
  $result -> execute();
  $filas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre de tienda</th>
      <th>Cantidad</th>
    </tr>
  
      <?php
        foreach ($filas as $f) {
          echo "<tr><td>$f[0]</td><td>$f[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>