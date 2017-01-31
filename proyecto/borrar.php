<?php
session_start();
if (empty($_GET))
die("Tienes que pasar algun parametro por GET.");
$a = $_GET['id'];
$connection= new mysqli("localhost", "tf", "12345", "proyecto_blog");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }
    if ($result = $connection->query("DELETE FROM USUARIOS
     where idUsuario=$a")) {
      echo "El usuario $a ha sido borrado con éxito.<br>";
      header("Location: paneladmin.php");
    } else {
        mysqli_error($connection);
  }
?>
