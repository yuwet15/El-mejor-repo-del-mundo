<?php
session_start();
include('../config/conexion.php');

 
if (isset($_POST['login'])) {   
    //session_start();
    $user = $_SESSION['rut'];
    $password = $_POST['actual_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];
    if($new_pass != $confirm_pass){
        $_SESSION['pass_dist'] = TRUE;
        header("Location: change_pass.php");
    }


    $query = "SELECT cambiar('$user', '$password', '$new_pass')";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();

    if ($result[0][0] == 'Success') {
        $_SESSION['success'] = TRUE;
        header("Location: change_pass.php");
    } else{
        $_SESSION['pass_inc'] = TRUE;
        header("Location: change_pass.php");
    }
    
}
 
?>