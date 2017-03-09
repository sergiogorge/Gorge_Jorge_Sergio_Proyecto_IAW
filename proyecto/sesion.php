<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if (isset($_SESSION["tipo"])){
    header("Location:error2.php");
  }
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Noticias Gorgé</title>

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
    <header class="intro-header" style="background-image: url('img/perrito.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Sesión</h1>
                        <hr class="small">
                        <span class="subheading">¿De verdad quieres entrar?.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if (!isset($_POST["nombre"])) : ?>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>Formulario inicio sesión</p>
                <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
                <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
                <!-- NOTE: To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
                <form name="inisesion" id="sesion" novalidate method="post">
                  <!--<form action= "panel-control.php" name="inisesion" id="sesion" novalidate method="post"> -->
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nombre usuario</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre de usuario" id="nombre" required data-validation-required-message="Escriba su nombre de usuario.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" name="password" placeholder="Contraseña " id="password" required data-validation-required-message="Escriba su contraseña.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-default">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php else :?>
<?php
$connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

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
      $_SESSION["id"]= $obj ->idUsuario;
      $_SESSION["tipo"] = $obj->tipo;
      $_SESSION["nombre"] = $obj->nombre_usuario;
      //echo "Bienvenido " . $_SESSION['username'];
  //  var_dump($_SESSION);
  //echo "<br><br><a href=index.php>Ir al inicio</a>";
   if ( $obj->tipo == 'admin') {
header("Location:admin/paneladmin.php");
echo "<br>";
}elseif ($obj->tipo == 'comun') {
header("Location:comun/panel-control.php");
echo "<br>";
  }

  }
}else {
 echo "Usuario o contraseñas incorrectos";
  echo "<br><a href='sesion.php'>Volver a Intentarlo</a>";

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

</body>

</html>
