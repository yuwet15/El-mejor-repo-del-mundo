<?php 
session_start();
include('../templates/header.html');   
if (isset($_SESSION['rut'])){
    if(isset($_SESSION['jefe'])){
        include('../templates/body_postlogin_jefe.html');
    } else {
        include('../templates/body_postlogin_normal.html');
    }   
} else {
    include('../templates/body_prelogin.html');
}
require("../config/conexion.php");

$query = "SELECT u.nombre, u.edad, u.rut, c.direccion
          FROM direcciones AS d, usuarios as u, comunas as c
          WHERE u.usuario_id = d.usuario_id
          AND d.direccion_id = c.direccion_id
          AND u.rut = "$_SESSION['RUT']";";

$result = $db -> prepare($query);
$result -> execute();
$user_info = $result -> fetchAll();
?>

<table class="table">
  
  <thead>
    <tr>
    <th>Nombre</th>
    <th>Edad</th>
    <th>Rut</th>
    <th>Dirección</th>
    </tr>
  </thead>
  
  <tbody>
    <?php
      foreach ($user_info as $i) {
          echo "<tr> <td>$i[0]</td> <td>$i[1]</td> 
                <td>$i[2]</td> <td>$i[3]</td> </tr>";
      }
    ?>
  </tbody>
</table>