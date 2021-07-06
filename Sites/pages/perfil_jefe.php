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
          FROM direcciones AS d, usuarios AS u, comunas AS c
          WHERE u.usuario_id = d.usuario_id
          AND d.direccion_id = c.direccion_id
          AND u.rut = '".$_SESSION['rut']."'";

$result = $db -> prepare($query);
$result -> execute();
$info = $result -> fetchAll();

$query = "SELECT p.nombre, p.edad, p.rut 
          FROM personal AS p, administracion AS a
          WHERE p.id = a.id
          AND p.rut != '".$_SESSION['rut']."'
          AND u.id IN (
          SELECT DISTINCT u.id
          FROM unidades as u, personal as p
          WHERE u.jefe_id = p.id
          AND p.rut = '".$_SESSION['rut']."')";

$result = $db -> prepare($query);
$result -> execute();
$empleados = $result -> fetchAll();
?>

<table class="table">
  
  <thead>
    <tr>
    <th>Nombre</th>
    <th>Edad</th>
    <th>Rut</th>
    <th>Dirección de mi unidad</th>
    </tr>
  </thead>
  
  <tbody>
    <?php
      foreach ($info as $i) {
        echo "<tr> <td>$i[0]</td> <td>$i[1]</td> 
                   <td>$i[2]</td> <td>$i[3]</td> </tr>";
      }
    ?>
  </tbody>
</table>

<br>
<h2> Empleados de la unidad </h2>
<br>

<table class="table">
  
  <thead>
    <tr>
    <th>Nombre</th>
    <th>Edad</th>
    <th>Rut</th>
    </tr>
  </thead>
  
  <tbody>
    <?php
      foreach ($empleados as $e) {
        echo "<tr> <td>$e[0]</td> <td>$e[1]</td> 
              <td>$e[2]</td> </tr>";
      }
    ?>
  </tbody>
</table>