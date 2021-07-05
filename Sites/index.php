<?php 
session_start();
include('templates/header.html');

if (isset($_SESSION['rut'])){
	if(isset($_SESSION['jefe'])){
		include('templates/i_body_postlogin_jefe.html');
	} else {
		include('templates/i_body_postlogin_normal.html');
	}	
} else {
	include('templates/i_body_prelogin.html');
}
include('config/conexion.php');
$query = "SELECT crear_tabla()";
$result = $db -> prepare($query);
$result -> execute();

$query2 = "SELECT rut FROM Usuarios";
$result2 = $db -> prepare($query);
$result2 -> execute();
foreach ($result2 as $rut){
    echo($rut);
    $query = "SELECT insertar_en_tabla($rut[0])";
    $result = $db -> prepare($query);
    $result -> execute();
}

$query3 = "SELECT rut FROM Personal";
$result3 = $db -> prepare($query);
$result3 -> execute();
foreach ($result3 as $rut){
    $query = "SELECT insertar_en_tabla($rut[0])";
    $result = $db -> prepare($query);
    $result -> execute();
}

$query4 = " SELECT p.rut FROM Personal as p, Administracion as a 
            WHERE a.id = p.id AND a.clasificacion = 'administracion'";
$result4 = $db2 -> prepare($query);
$result4 -> execute();
foreach ($result4 as $rut){
    $query = "SELECT insertar_en_tabla($rut[0])";
    $result = $db -> prepare($query);
    $result -> execute();
}


 

$query = "SELECT rut, cargo from Personal";
$result = $db -> prepare($query);
$result -> execute();
 
$result = $result -> fetchAll();
?>
<table class='table'>
    <thead>
        <tr>
        <th>Rut</th>
        <th>Cargo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result as $usuario) {
            echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> </tr>";
        }
        ?>
    </tbody>
</table>



    

    
</body>
</html>