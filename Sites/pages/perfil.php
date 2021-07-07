<?php 
session_start();
   
if (isset($_SESSION['rut'])){
  include('../templates/header.html');
  include('../templates/body_postlogin.html');
} else {
    header("Location: ../index.php");
}
require("../config/conexion.php");


if (isset($_SESSION['jefe'])){
  $query = "SELECT u.nombre, u.edad, u.rut, c.direccion
            FROM direcciones AS d, usuarios AS u, comunas AS c
            WHERE u.usuario_id = d.usuario_id
            AND d.direccion_id = c.direccion_id
            AND u.rut = '".$_SESSION['rut']."'";

  $result = $db -> prepare($query);
  $result -> execute();
  $user_info = $result -> fetchAll();

  $query = "SELECT p.nombre, p.edad, p.rut 
            FROM personal AS p, administracion AS a
            WHERE p.id = a.id
            AND p.rut != '".$_SESSION['rut']."'
            AND a.unidad_id IN (
            SELECT DISTINCT u.id
            FROM unidades as u, personal as p
            WHERE u.jefe_id = p.id
            AND p.rut = '".$_SESSION['rut']."')";

  $result = $db2 -> prepare($query);
  $result -> execute();
  $empleados = $result -> fetchAll();
}else{
  $query = "SELECT nombre, edad, rut
            FROM usuarios
            WHERE rut = '".$_SESSION['rut']."'";

  $result = $db -> prepare($query);
  $result -> execute();
  $user_info = $result -> fetchAll();

  $query = "SELECT DISTINCT c.direccion
            FROM direcciones AS d, usuarios as u, comunas as c
            WHERE u.usuario_id = d.usuario_id
            AND d.direccion_id = c.direccion_id
            AND u.rut = '".$_SESSION['rut']."'";

  $result = $db -> prepare($query);
  $result -> execute();
  $user_address = $result -> fetchAll();

  if(!$user_info){
    $query = "SELECT nombre, edad, rut
              FROM Personal
              WHERE rut = '".$_SESSION['rut']."'";

    $result = $db -> prepare($query);
    $result -> execute();
    $user_info = $result -> fetchAll();
  }
}

?>

<table class="table">
  
  <thead>
    <tr>
    <th>Nombre</th>
    <th>Edad</th>
    <th>Rut</th>
    <?php
    if(isset($_SESSION['jefe'])){
      echo "<th>Dirección de mi unidad</th>";
    }
    ?>
    </tr>
  </thead>
  
  <tbody>
    <?php
      foreach ($user_info as $i) {
          echo "<tr> <td>$i[0]</td> <td>$i[1]</td> 
                <td>$i[2]</td>";
          if(isset($_SESSION['jefe'])){
            echo "<td>$i[3]</td>";
          }
          echo "</tr>";
      }
    ?>
  </tbody>
</table>

<?php
if(!$user_address){
  echo $user_address;
  echo "Usuario no presenta direcciones registradas";
}else{
  echo "<table class=\"table\">";
    
    echo "<thead>";
      echo "<tr>";
      echo "<th>Direcciones registradas</th>";
      echo "</tr>";
    echo "</thead>";
    
    echo "<tbody>";
      
        foreach ($user_address as $a) {
            echo "<tr> <td>$a[0]</td> </tr>";
        }
      
    echo "</tbody>";
  echo "</table>";
}

if(isset($_SESSION['jefe'])){

}



?>