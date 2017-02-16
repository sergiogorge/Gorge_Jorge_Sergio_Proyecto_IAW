<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  //Bucle que si $_GET no tiene nada, diga que hay que pasar algo
  if (empty($_GET))
  die("Tienes que pasar algun parametro por GET.");
  //Declaración de la variable item y se le introduce lo que viene de GET
  $a = $_GET['id'];
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

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">Noticias Gorgé</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <?php
                 if (!isset($_SESSION["tipo"])){
                  echo '<a href="index.php">Inicio</a>';
                 }else{
                 if (isset($_SESSION["tipo"])){
                   echo '<a href="index.php">Inicio</a>';
                 }
                 }
                 ?>
                </li>

                <li>
                    <?php
                    if (isset($_SESSION["username"])){
                    echo '<a href="logout.php">Hola '.$_SESSION['username'].'.Cerrar sesión.</a>';
                    } else {
                    echo '<a href="sesion.php">Iniciar sesión</a>';
                    }
                    ?>
                  </li>    
               <li>
                  <?php
                  if (!isset($_SESSION["tipo"])){
                 echo '<a href="register.php">Registrarse.</a>';
                 }else{
                 if ($_SESSION["tipo"]=='admin'){
                 echo '<a href="paneladmin.php">Panel de Control admin.</a>';
                 }elseif ($_SESSION["tipo"]=='comun') {
                 echo '<a href="index.php">Panel de Control.</a>';
                 }
                 }
              ?>
            </li>
             </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/gatito.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Editar datos</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <?php if (!isset($_POST["nombreusu"])) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>Editar user</p>

                <form  name="regis" id="registrer" onSubmit="return validarPasswd()" novalidate method="post">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nuevo nombre usuario</label>
                            <input type="text" name="nombreusu" class="form-control" placeholder="Nuevo nombre" id="name" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nuevo email</label>
                            <input type="email" name="newemail" class="form-control" placeholder="Nuevo email" id="nemail" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nueva contraseña</label>
                            <input type="password" name="newpassword" class="form-control" placeholder="Nueva contraseña" id="npassword" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Confirmar nueva contraseña</label>
                            <input type="password" name="cnewpassword" class="form-control"  placeholder="Confirmar nueva contraseña" id="ncpassword" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-default" name="regis">Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <?php else: ?>
    <?php
    //if (empty($_GET))
    //die("Tienes que pasar algun parametro por GET.");
    //$a = $_GET['id'];
       $connection2 = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
        if ($connection2->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
          }
          $userName = $_POST['nombreusu'];
          $password = $_POST['newpassword'];
          $email = $_POST['newemail'];
          $cons="SELECT * FROM usuarios WHERE nombre_usuario = '$userName'  OR email='$email' ";
          $result2  = $connection2->query($cons);
          if ($result2->num_rows==0) {
            if(isset($_POST['nombreusu']) && $_POST['nombreusu']!=="" ){
          $consulta= "UPDATE `usuarios` SET `nombre_usuario` = '$userName'
           WHERE `usuarios`.`idUsuario` = '$a' ";
          $result = $connection2->query($consulta);
           }
          if(isset($_POST['newemail']) && $_POST['newemail']!=="" ){
            $consulta= "UPDATE `usuarios` SET `email` = '$email'
             WHERE `usuarios`.`idUsuario` = '$a' ";
            $result = $connection2->query($consulta);
          }
          if(isset($_POST['newpassword']) && $_POST['newpassword']!=="" ){
            $consulta= "UPDATE `usuarios` SET `password` = md5('$password')
             WHERE `usuarios`.`idUsuario` = '$a' ";
            $result = $connection2->query($consulta);

            }
            if (!$result) {
               echo "error";
            } else {
              echo "Datos cambiados";
              if (isset($_POST["nombreusu"]) && $_POST["nombreusu"]!=""){
              $_SESSION["username"]=$_POST["nombreusu"];
              header("Refresh:2; url=index.php");
            }
             }
          }else {
          echo "Esos datos están en uso";
          header("Refresh:2; url=index.php");
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
    <script src="js/checkpassed.js"></script>

</body>

</html>
