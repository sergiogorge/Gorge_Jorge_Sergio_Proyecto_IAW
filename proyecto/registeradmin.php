<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
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
    <?php if (!isset($_POST["adnombreusu"])) : ?>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>Formulario de registro</p>
                <form  name="regis" id="registrer"  onSubmit="return validarPasswd()" novalidate method="post">
            <!--      <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>ID Usuario</label>
                          <input type="text" name="adidusu" class="form-control" placeholder="id usuario" id="id" required>
                          <p class="help-block text-danger"></p>
                  </div>
                </div>-->
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Tipo Usuario</label>
                        <select class="form-control" name="adtipousu" placeholder="tipousu" id="anadetipousu">
                          <option>admin</option>
                          <option>comun</option>
                        </select>
                    </div>
                </div>

                          <!--<label>Tipo</label>
                          <input type="text" name="adtipousu" class="form-control" placeholder="Tipo usuario" id="type" required>
                          <p class="help-block text-danger"></p>-->

                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nombre usuario</label>
                            <input type="text" name="adnombreusu" class="form-control" placeholder="Nombre" id="name" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Email</label>
                            <input type="email" name="adnewemail" class="form-control" placeholder="Email " id="nemail" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Contraseña</label>
                            <input type="password" name="adnewpassword" class="form-control" placeholder="Contraseña" id="npassword" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Confirmar contraseña</label>
                            <input type="password" name="adcnewpassword" class="form-control"  placeholder="Confirmar contraseña" id="ncpassword" required>
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
  //$id   = $_POST['adidusu'];
  $tipo   = $_POST['adtipousu'];
  $userName = $_POST['adnombreusu'];
  $password = $_POST['adnewpassword'];
  $email = $_POST['adnewemail'];
  $cons="SELECT * FROM usuarios WHERE nombre_usuario = '$userName'  AND password = md5('$password') OR email='$email' ";
  $result2 = $connection2->query($cons);
  if ($result2->num_rows==0) {
  $consulta= "INSERT INTO usuarios (idUsuario,tipo,password,email,nombre_usuario,fecha_registro)
  VALUES (NULL,'$tipo',md5('$password'),'$email','$userName',sysdate())";
  $result = $connection2->query($consulta);
  if (!$result) {
     echo "error";
  } else {
    echo "Registro completado";
    header("Refresh:2; url=paneladmin.php");
  }
   } else {
    echo "Ese user ya está registrado";
    header("Refresh:2; url=paneladmin.php");
  }
  ?>
<?php endif ?>
    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="http://www.twitter.com/sergiogorge">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Gorgé 2016</p>

                </div>
            </div>
        </div>
      </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

    <!--Check password -->
    <script src="js/checkpass.js"></script>
</body>
</html>
