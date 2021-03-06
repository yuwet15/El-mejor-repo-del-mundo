<?php 
session_start();


   
if (isset($_SESSION['rut'])){
  include('../templates/header.html');
  include('../templates/body_postlogin.html');
} else {
    header("Location: ../index.php");
}
require("../config/conexion.php");


if (isset($_SESSION['jefe']) || isset($_SESSION['trabajador'])){
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

  $query = "SELECT DISTINCT c.direccion
            FROM direcciones AS d, usuarios as u, comunas as c
            WHERE u.usuario_id = d.usuario_id
            AND d.direccion_id = c.direccion_id
            AND u.rut = '".$_SESSION['rut']."'";

  $result = $db -> prepare($query);
  $result -> execute();
  $user_address = $result -> fetchAll();

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
    $query = "SELECT DISTINCT c.direccion
              FROM personal as p, tiendas as t, comunas as c
              WHERE t.direccion_id = c.direccion_id
              AND p.tienda_id = t.tienda_id
              AND p.rut = '".$_SESSION['rut']."'";

    $result = $db -> prepare($query);
    $result -> execute();
    $user_address = $result -> fetchAll();
  }
}



?>
<br>
<div class="container" style="background-color:#dce1e3">
  <table class="table">
    
    <thead>
      <tr>
      <th>Nombre</th>
      <th>Edad</th>
      <th>Rut</th>
      <?php
      if(isset($_SESSION['jefe'])){
        echo "<th>Direcci??n de mi unidad</th>";
      }elseif(isset($_SESSION['trabajador']) || isset($_SESSION['E_tienda'])) {
        echo "<th>Direcci??n de trabajo</th>";
      }elseif(isset($_SESSION['J_tienda'])){
        echo "<th>Direcci??n de mi tienda</th>";
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
            }elseif(isset($_SESSION['trabajador']) || isset($_SESSION['E_tienda']) || isset($_SESSION['J_tienda'])){
              echo "<td>".$user_address[0][0]."</td>";
            }
            echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</div>
<?php
if(isset($_SESSION['jefe']) || isset($_SESSION['trabajador'])){
  echo "";//No es nada xD
}elseif(!$user_address){
  echo "Usuario no presenta direcciones registradas";
}else{
  echo "<br>";
  echo "<div class=\"container\" style=\"background-color:#dce1e3\">";
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
  echo "</div>";
}

if(isset($_SESSION['jefe'])){
  echo "<br>
          <h2> Empleados de la unidad </h2>
        <br>";
  echo "<table class=\"table\">
  
          <thead>
            <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Rut</th>
            </tr>
          </thead>
          
          <tbody>";
              foreach ($empleados as $e) {
                echo "<tr> <td>$e[0]</td> <td>$e[1]</td> 
                      <td>$e[2]</td> </tr>";
              }
  echo "  </tbody>
        </table>";
}



?>
</body>