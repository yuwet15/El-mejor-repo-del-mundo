<?php
session_start();
include('../config/conexion.php');

if (isset($_POST['register'])) {   
    
    $nombre = $_POST['nombre'];
    $rut = $_POST['rut'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $direccion = $_POST['direccion'];

    
    $query = "SELECT register('$nombre', '$rut', $edad, '$sexo', '$direccion', usuario)";
    $result = $db -> prepare($query);
    $result -> execute();

    $result = $result -> fetchAll();
    if ($result[0][0] == 'TRUE') {
        $query = "SELECT insertar_en_tabla('$rut');";
        $result = $db -> prepare($query);
        $result -> execute();
        $_SESSION['register'] = 'TRUE';
        header("Location: login.php");

    }elseif ($result[0][0] == 'No_direccion'){
        $_SESSION['no_dic'] = 'TRUE';
        $_SESSION['nombre_r'] = $nombre;
        $_SESSION['rut_r'] = $rut;
        $_SESSION['edad_r'] = $edad;
        $_SESSION['sexo_r'] = $sexo;
        $_SESSION['direccion_r'] = $direccion;

        header("Location: register.php");
    }else{
        $_SESSION['rut_ext'] = 'TRUE';
        $_SESSION['nombre_r'] = $nombre;
        $_SESSION['rut_r'] = $rut;
        $_SESSION['edad_r'] = $edad;
        $_SESSION['sexo_r'] = $sexo;
        $_SESSION['direccion_r'] = $direccion;

        header("Location: register.php");
    }

    
}
 
?>