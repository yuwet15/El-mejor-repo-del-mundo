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
if (!isset($_SESSION['tablas_user'])){
    include('config/conexion.php');
    
    $query = "SELECT crear_tabla()";
    $result = $db -> prepare($query);
    $result -> execute();

    $query = "SELECT crear_tabla()";
    $result = $db -> prepare($query);
    $result -> execute();

    $query2 = "SELECT rut FROM Usuarios";
    $result2 = $db -> prepare($query2);
    $result2 -> execute();
    $result2 = $result2 -> fetchAll();
    foreach ($result2 as $rut){
        $query = "SELECT insertar_en_tabla('$rut[0]')";
        $result = $db -> prepare($query);
        $result -> execute();
    }

    $query3 = "SELECT rut FROM Personal";
    $result3 = $db -> prepare($query3);
    $result3 -> execute();
    $result3 = $result3 -> fetchAll();
    foreach ($result3 as $rut){
        $query = "SELECT insertar_en_tabla('$rut[0]')";
        $result = $db -> prepare($query);
        $result -> execute();
    }

    $query4 = " SELECT p.nombre, p.rut, p.edad, p.sexo, a.clasificacion 
                FROM Personal as p, Administracion as a 
                WHERE a.id = p.id";
    $result4 = $db2 -> prepare($query4);
    $result4 -> execute();
    $datos = $result4 -> fetchAll();
    foreach ($datos as $d){
        $query = "SELECT insertar_en_tabla('$d[1]'), 
                  transferir_usuario('$d[0]', '$d[1]', '$d[2]', '$d[3]', '$d[4]'";
        $result = $db -> prepare($query);
        $result -> execute();
    }
    $_SESSION['tablas_user'] = 'SET xD';
}
?>


<table class='table'>
    <thead>
        <tr>
        <th>Rut</th>
        <th>Cargo</th>
        </tr>
    </thead>
    <tbody>
        <tr> <td>46251263-5</td> <td>Empleado</td> </tr>
        <tr> <td>36669949-k</td> <td>Jefe</td> </tr>
        <tr> <td>33461543-k</td> <td>Administrativo</td> </tr>
    </tbody>
</table>



    

    
</body>
</html>