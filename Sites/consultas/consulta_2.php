<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = $_POST["comuna"];
  $comuna = intval($comuna);

  #Se construye la consulta como un string
  $query = "SELECT pid, nombre, altura FROM pokemones where altura>=$altura order by altura desc;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db -> prepare($query);
  $result -> execute();
  $pokemones = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Altura</th>
    </tr>
  
      <?php
        // echo $pokemones;
        foreach ($pokemones as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>