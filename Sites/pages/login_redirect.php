<?php
 
include('../config/conexion.php');

 
if (isset($_POST['login'])) {   
    //session_start();
    
    $username = $_POST['rut'];
    $password = $_POST['password'];
    $query = "SELECT login('$username', '$password')";
    $result = $db -> prepare($query);
    $result -> execute();
 
    $result = $result -> fetchAll();
 
    if (!$result) {
        header("Location: login.php");
        echo '<p class="error">Error en la combinacion de rut y contraseña</p>';
    } else {
        $_SESSION['rut'] = $username;
        //Falta comprobar si es o no jefe
        $query = "SELECT cargo FROM Personal WHERE rut = '$username'"; 
        $result = $db -> prepare($query);
        $result -> execute();
     
        $result = $result -> fetchAll();
        if($result[0][0] == 'Jefe'){
          $_SESSION['jefe'] = TRUE;
        };
        header("Location: ../index.php");
        echo '<p class="success">Sesion iniciada</p>';
    }
}
 
?>