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
?>
<?php
require("../config/conexion.php");

$query = "SELECT nombre FROM tiendas;";

	$result = $db -> prepare($query);
	$result -> execute();
	$tiendas = $result -> fetchAll();
  ?>

<table>
    <tr>
      <th>Tiendas</th>
    </tr>
  
      <?php
        foreach ($tiendas as $t) {
          echo "<tr><td>'<a href="tiendas2.php">$t[0]</a>'</td></tr>";
      }
      ?>
      
  </table>


