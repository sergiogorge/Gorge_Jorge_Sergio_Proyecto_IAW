<?php
session_start();
if (empty($_GET))
die("Tienes que pasar algun parametro por GET.");
$a = $_GET['idc'];
$connection= new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }
    if ($result = $connection->query("DELETE FROM comentarios
     where idComentario='$a'")) {
      echo "El comentario $a ha sido borrado con éxito.<br>";
      header("Location:notcompleta.php");
    } else {
        mysqli_error($connection);
  }
?>
