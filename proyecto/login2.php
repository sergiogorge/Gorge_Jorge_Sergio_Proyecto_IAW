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
        if (isset($_POST["nombre"])) {

          $connection = new mysqli("localhost", "tf", "12345", "proyecto_blog");

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          $consulta="select * from usuarios where
          nombre_usuario='".$_POST["nombre"]."' and password=md5('".$_POST["password"]."');";


          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
                echo "LOGIN INVALIDO";
                echo "<br><a href='sesion.php'>Volver a Intentarlo</a>";
              } else {

                $_SESSION["username"]=$_POST["nombre"];
                $_SESSION["language"]="es";
                $obj=$result->fetch_object();
                $_SESSION["tipo"] = $obj->tipo;
                //echo "Bienvenido " . $_SESSION['username'];
              // var_dump($_SESSION);
              //  echo "<br><br><a href=index.php>Ir al inicio</a>";

              header("Location: index.php");
              }

          } else {
            echo "Usuario o contraseñas incorrectos";
            echo "<br><a href='sesion.php'>Volver a Intentarlo</a>";

          }
      }
    ?>
  </head>
</body>
