<?php 
session_start();
include('templates/header.html');

echo "<body style='background-color:#E6EAEB'>";

if (isset($_SESSION['rut'])){
	include('templates/i_body_postlogin.html');
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

    $query4 = " SELECT p.nombre, p.rut, p.edad, p.sexo, a.clasificacion, u.direccion_id
                FROM personal AS p, administracion AS a, unidades AS u
                WHERE a.id = p.id
                AND a.unidad_id = u.id";
    $result4 = $db2 -> prepare($query4);
    $result4 -> execute();
    $datos = $result4 -> fetchAll();
    foreach ($datos as $d){
        $query = "SELECT insertar_en_tabla('$d[1]'),
                  transferir_usuario('$d[0]', '$d[1]', $d[2], '$d[3]', '$d[4]', '$d[5]')";
        $result = $db -> prepare($query);
        $result -> execute();
    }
    $_SESSION['tablas_user'] = 'SET xD';
}
?>

<br>

<h1 style="text-align: center;">Bienvenido a Mi tienda Online</h1>
<h3 style="text-align: center;">Colaboracion de grupo 27 y grupo 106</h3>
<h3 style="text-align: center;">Abajo tiene algunos usuarios para probar iniciar sesion donde la clave por defecto son los 4 digitos antes del numero verificador</h3>
<div class="container" style="background-color:#dce1e3">
    <table class='table'>
        <thead>
            <tr>
            <th>Rut</th>
            <th>Cargo</th>
            </tr>
        </thead>
        <tbody>
            <tr> <td>46251263-5</td> <td>Empleado</td> </tr>
            <tr> <td>28630079-0</td> <td>Usuario</td> </tr>
            <tr> <td>33461543-k</td> <td>Administrativo</td> </tr>
            <tr> <td>70433997-6</td> <td>Ti</td> </tr>
            <tr> <td>46188032-0</td> <td>Asistente de aseo</td> </tr>
            <tr> <td>77941465-5</td> <td>Vendedor</td> </tr>
        </tbody>
    </table>
</div>


    

    
</body>
</html>