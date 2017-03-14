<?php
session_start();
if ($_SESSION["tipo"]!=='admin'){
   session_destroy();
    header("Location:../error.php");
  }
if (empty($_GET))
die("Tienes que pasar algun parametro por GET.");
$a = $_GET['id'];
$imagen="";
$connection= new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }

if ($result2 = $connection->query("SELECT noticia.* FROM noticia where idnoticia=$a;")) {
           $obj = $result2->fetch_object();
           //var_dump($obj);
           $imagen="../$obj->image";
           $result2->close();
           unset($obj);

    }

if ($result = $connection->query("DELETE FROM noticia where idnoticia=$a")) {

      unlink($imagen);
      echo "La noticia ha sido borrada con éxito.<br>";
      echo "$imagen";
    header("Location: ../paneladmin.php");
    } else {
        mysqli_error($connection);
  }

  unset($connection);
?>
