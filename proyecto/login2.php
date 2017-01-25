<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href=" ">
  </head>
  <body>

    <?php
        //FORM SUBMITTED
        if (isset($_POST["nombre"])) {

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "tf", "12345", "proyecto_blog");

          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $consulta="select * from usuarios where
          nombre_usuario='".$_POST["nombre"]."' and password=md5('".$_POST["password"]."');";

          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {

              //No rows returned
              if ($result->num_rows===0) {
                echo "LOGIN INVALIDO";
                echo "<br><a href='sesion.php'>Volver a Intentarlo</a>";
              } else {
                //VALID LOGIN. SETTING SESSION VARS
                $_SESSION["username"]=$_POST["nombre"];
                $_SESSION["language"]="es";
                $obj=$result->fetch_object();
                $_SESSION["tipo"] = $obj->tipo;
                echo "Bienvenido " . $_SESSION['username'];
                var_dump($_SESSION);
                echo "<br><br><a href=index.php>Ir al inicio</a>";
                //header("Location: index.php");
              }

          } else {
            echo "Usuario o contraseñas incorrectos";
            echo "<br><a href='sesion.php'>Volver a Intentarlo</a>";

          }
      }
    ?>
  </head>
</body>
