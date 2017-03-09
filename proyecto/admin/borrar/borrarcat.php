<?php
session_start();
if (empty($_GET))
die("Tienes que pasar algun parametro por GET.");
$a = $_GET['id'];
$imagen="";
$connection= new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }
   if ($result2 = $connection->query("SELECT noticia.* FROM noticia join categorias on noticia.idcategoria=categorias.idcategoria where categorias.idcategoria=$a;")) {
     while ($obj = $result2->fetch_object()) {
       $imagen="../$obj->image";
       unlink($imagen);
     }
  }else{
    echo "error de consulta";
    exit();
  }

  if ($result = $connection->query("DELETE FROM categorias where idcategoria=$a;")) {
        echo "La categoria ha sido borrada con éxito.<br>";
        header("Location: ../paneladmin.php");
       } else {
           mysqli_error($connection);
      }

?>
