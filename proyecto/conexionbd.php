
<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href=" ">
    </head>
    <body>
      <!--Archivo PHP que conecta con la base de datos!-->
      <?php
      $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
        }
          ?>
         </body>
</html>
