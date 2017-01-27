<?php
 define('DB_HOST', 'localhost');
 define('DB_NAME', 'proyecto_blog');
 define('DB_USER','tf');
 define('DB_PASSWORD','12345');
 $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
 $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
  function NewUser()
 {
    $userName = $_POST['nombreusu'];
   $email = $_POST['newemail'];
   $password = $_POST['newpassword'];
   $cpassword = $_POST['cnewpassword'];
   $query = "INSERT INTO usuarios (idUsuario,tipo,password,email,nombre_usuario,fecha_registro)
   VALUES (NULL,'comun',md5('$password'),'$email','$userName',sysdate())";
   $data = mysql_query ($query)or die(mysql_error());
   if($data) {
      echo "Registro completado";
      echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php">';
    }
  }

  function SignUp()
  {
     if(!empty($_POST['nombreusu']))
      $userName = $_POST['nombreusu'];
      $password = $_POST['newpassword'];
      $email = $_POST['newemail'];
      $query = mysql_query("SELECT * FROM usuarios WHERE nombre_usuario = '$userName'  AND password = md5('$password') OR email='$email'" ) or die(mysql_error());
      if(!$row = mysql_fetch_array($query)){
        NewUser();
    }else{
      echo "Ya estás registrado";
      echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php">';
        }

}

    if(isset($_POST['regis']))
    {
    	SignUp();
    }

 ?>
 <!--Check password -->
 <script src="js/checkpass.js"</script>
