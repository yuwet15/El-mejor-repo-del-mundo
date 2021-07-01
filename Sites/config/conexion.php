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
      echo "No se pudo conectar a la base de datos 2: $e";
    }
?>
wena