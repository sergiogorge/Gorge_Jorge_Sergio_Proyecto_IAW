<?php
session_start();
if (empty($_GET))
die("Tienes que pasar algun parametro por GET.");
$a = $_GET['id'];
$connection= new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }
    if ($result = $connection->query("DELETE FROM valoraciones
     where idValoracion='$a'")) {
      echo "Las valoraciones han sido borradas con éxito.<br>";
      header('Location:' . getenv('HTTP_REFERER'));
    } else {
        mysqli_error($connection);
  }
?>
