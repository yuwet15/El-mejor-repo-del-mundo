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

if (isset($_SESSION['rut'])){
  if(isset($_SESSION['jefe'])){
    $query = "SELECT DISTINCT nombre, edad, rut
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
    ?>

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
    foreach ($user_info as $i) {
        echo "<tr> <td>$i[0]</td> <td>$i[1]</td> 
              <td>$i[2]</td> </tr>";
    }
    ?>
    </tbody>
    </table>

    <table class="table">

    <thead>
    <tr>
    <th>Direcciones registradas</th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($user_address as $a) {
        echo "<tr> <td>$a[0]</td> </tr>";
    }
    ?>
    </tbody>
    </table>
  } else {
      
  }   
} else {
  
}
