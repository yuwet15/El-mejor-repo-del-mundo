<?php 
session_start();
if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
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
          echo "<tr><td><a href="tiendas2.php">{$t[0]}</a></td></tr>";
      }
      ?>
      
  </table>


