<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
<<<<<<< HEAD
  if (isset($_SESSION["tipo"])){
  header("Location:error2.php");
}
=======
    if (isset($_SESSION["tipo"])){
    header("Location:error2.php");
  }
>>>>>>> 3dfd84384bc1fb7042e94490fb51fc81087e7352

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Noticias Gorgé - Contacto</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <?php
  include_once("header.php");
   ?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/gatito.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Registrarse</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php if (!isset($_POST["nombreusu"])) : ?>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>Formulario de registro</p>

                <form  name="regis" id="registrer"  onSubmit="return validarPasswd()" novalidate method="post">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nombre usuario</label>
                            <input type="text" name="nombreusu" class="form-control" placeholder="Nombre" id="name" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Email</label>
                            <input type="email" name="newemail" class="form-control" placeholder="Email " id="nemail" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Contraseña</label>
                            <input type="password" name="newpassword" class="form-control" placeholder="Contraseña" id="npassword" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Confirmar contraseña</label>
                            <input type="password" name="cnewpassword" class="form-control"  placeholder="Confirmar contraseña" id="ncpassword" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-default" name="regis">Registrarse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php else : ?>
  <?php
        $connection2 = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
         if ($connection2->connect_errno) {
           printf("Connection failed: %s\n", $connection->connect_error);
           exit();
         }
        $userName = $_POST['nombreusu'];
        $password = $_POST['newpassword'];
        $email = $_POST['newemail'];
        $cons="SELECT * FROM usuarios WHERE nombre_usuario = '$userName'  AND password = md5('$password') OR email='$email' " ;
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

  ?>
<?php endif ?>


    <?php
    include("footer.php");
     ?>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

    <!--Check password -->
    <script src="js/checkpass.js"></script>
</body>

</html>
