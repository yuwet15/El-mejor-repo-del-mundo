<?php
session_start();
include('../config/conexion.php');

 
if (isset($_POST['login'])) {   
    //session_start();
    
    $username = $_POST['rut'];
    $password = $_POST['password'];
    $query = "SELECT login('$username', '$password')";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();
    if ($result[0][0] == 'Password incorrect') {
        $_SESSION['pass_inc'] = TRUE;
        header("Location: login.php");
    } elseif ($result[0][0] == 'Success') {
        $_SESSION['rut'] = $username;
        //Falta comprobar si es o no jefe
        $query = "SELECT cargo FROM Usuarios WHERE rut = '$username'"; 
        $result = $db -> prepare($query);
        $result -> execute();
     
        $result = $result -> fetchAll();
        if(!$result[0][0]){
            $query = "SELECT cargo FROM Personal WHERE rut = '$username'"; 
            $result = $db -> prepare($query);
            $result -> execute();
            $result = $result -> fetchAll();
            if($result[0][0] == 'Jefe'){
                $_SESSION['J_tienda'] = TRUE;
            }else{
                $_SESSION['E_tienda'] = TRUE;
            }
        }elseif($result[0][0] == 'administracion'){
            $_SESSION['jefe'] = TRUE;
        }elseif ($result[0][0] != 'usuario') {
            $_SESSION['trabajador'] = TRUE;
        };
        header("Location: ../index.php");
    } else {
        $_SESSION['no_user'] = TRUE;
        header("Location: login.php");
    }
}
 
?>