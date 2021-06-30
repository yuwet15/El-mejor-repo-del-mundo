<?php
  try {
    require('data.php'); 
    $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos 1: $e";
  }
  try {
    require('data.php');
    $db2 = new PDO("pgsql:dbname=$databaseName2;host=localhost;port=5432;user=$user2;password=$password2");
    } catch (Exception $e) {
<<<<<<< HEAD
      echo "No se pudo conectar a la base de datos 2: $e";
=======
      echo "No se pudo conectar a la base de datos: $e";
>>>>>>> c5647a5c27ac490a2cdbf19ff4a3ba7f6724e9af
    }
?>