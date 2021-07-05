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

?>

Home
<?php
 
include('config/conexion.php');

 

$query = "SELECT rut, cargo from Personal";
$result = $db -> prepare($query);
$result -> execute();
 
$result = $result -> fetchAll();?>
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