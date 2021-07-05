<?php
session_start();
include('../config/conexion.php');

if (isset($_POST['register'])) {   
    
    $nombre = $_POST['nombre'];
    $rut = $_POST['rut'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $direccion = $_POST['direccion'];

    
    $query = "SELECT register('$nombre', '$rut', $edad, '$sexo', '$direccion')";
    $result = $db -> prepare($query);
    $result -> execute();

    $result = $result -> fetchAll();
    echo($result[0][0]);

    if ($result[0][0] == 'ok') {
        $_SESSION['register'] = 'TRUE';
        header("Location: login.php");

    }elseif ($result[0][0] == 'No_direccion'){
        $_SESSION['no_dic'] = 'TRUE';
    }else{
        $_SESSION['rut_ext'] = 'TRUE';
    }

    $_SESSION['nombre_r'] = $nombre;
    $_SESSION['rut_r'] = $rut;
    $_SESSION['edad_r'] = $edad;
    $_SESSION['sexo_r'] = $sexo;
    $_SESSION['direccion_r'] = $direccion;
    //header("Location: register.php");
}
 
?>