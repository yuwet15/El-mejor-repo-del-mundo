<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $descripcion = strtolower($_POST["descripcion"]);

  #Se construye la consulta como un string
  $query = "SELECT u.nombre, p.nombre, p.descripcion
  FROM Usuarios as u, Productos as p, Compras as c, Detalle as d
  WHERE p.producto_id = d.producto_id AND d.compra_id = c.compra_id AND c.usuario_id = u.usuario_id AND p.descripcion LIKE '%$descripcion%';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db -> prepare($query);
  $result -> execute();
  $filas = $result -> fetchAll();
  ?>
  <center>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Producto</th>
      <th>Descripcion</th>
    </tr>

      <?php
        foreach ($filas as $f) {
          echo "<tr><td>$f[0]</td><td>$f[1]</td><td>$f[2]</td></tr>";
      }
      ?>

  </table>
  </center>

<?php include('../templates/footer.html'); ?>
