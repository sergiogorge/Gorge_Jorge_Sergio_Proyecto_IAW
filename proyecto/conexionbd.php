<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIBETIS</title>
    <link rel="stylesheet" type="text/css" href=" ">
    </head>
    <body>
      <!--Archivo PHP que conecta con la base de datos!-->
      <?php
        //Realiza la conexión
        $connection = new mysqli("localhost", "tf", "12345", "proyecto_blog");
        //Que te diga el error si falla la conexión
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        //Con esto puedes poner tildes
        $connection->query("SET NAMES 'utf8'");
        ?>
         </body>
</html>
