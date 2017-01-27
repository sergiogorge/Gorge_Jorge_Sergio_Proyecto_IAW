<?php

   if(isset($_POST['nombreusu'])){
      $connection2 = new mysqli("localhost", "tf", "12345", "proyecto_blog");
       if ($connection2->connect_errno) {
         printf("Connection failed: %s\n", $connection->connect_error);
         exit();
         }
      $userName = $_POST['nombreusu'];
      $password = $_POST['newpassword'];
      $email = $_POST['newemail'];
      $cons="SELECT * FROM usuarios WHERE nombre_usuario = '$userName'  AND password = md5('$password') ";
      $result2 = $connection2->query($cons);
      if ($result2->num_rows==0) {
      $consulta= "INSERT INTO usuarios (idUsuario,tipo,password,email,nombre_usuario,fecha_registro)
      VALUES (NULL,'comun',md5('$password'),'$email','$userName',sysdate())";
      $result = $connection2->query($consulta);
      if (!$result) {
         echo "error";
      } else {
        echo "Registro completado";
        header("Refresh:2; url=index.php");
      }
       } else {
        echo "Ya estás registrado";
        header("Refresh:2; url=index.php");
      }
    }
?>
