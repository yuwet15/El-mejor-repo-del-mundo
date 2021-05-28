<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = $_POST["comuna"];

  #Se construye la consulta como un string
  $query = "SELECT ROUND(AVG(p.edad),0)
  FROM Tiendas as t, Personal as p, Comunas as c
  WHERE t.tienda_id = p.tienda_id AND c.direccion_id = t.direccion_id AND c.comuna = '$comuna';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db -> prepare($query);
  $result -> execute();
  $filas = $result -> fetchAll();
  foreach ($filas as $f) {
      echo "Promedio de edad: $f[0]";
  }
  
  ?>


<?php include('../templates/footer.html'); ?>