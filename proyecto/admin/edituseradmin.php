<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
if ($_SESSION["tipo"]!=='admin'){
  session_destroy();
  header("Location:error.php");
}
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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
    <header class="intro-header" style="background-image: url('../img/gatito.jpg')">
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
                          <label>Editar tipo usuario</label>
                             <select class="form-control" name="edtipousu" placeholder="tipousu" id="edittipousu">
                               <?php
                               $connection= new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                                if ($connection->connect_errno) {
                                  printf("Connection failed: %s\n", $connection->connect_error);
                                  exit();
                                  }

                               if ($result2 = $connection->query("SELECT * FROM usuarios where idusuario=$a;")) {
                                          $obj = $result2->fetch_object();
                                          $tipo=$obj->tipo;
                                          $result2->close();
                                   }
                             if($tipo=='admin'){
                               echo'<option selected="selected">admin</option>';
                               echo'<option >comun</option>';
                             }elseif($tipo=='comun'){
                               echo'<option>admin</option>';
                               echo'<option selected="selected">comun</option>';
                             }
                                    unset($obj);
                                    unset($connection);
                               ?>
                             </select>
                         </div>
                     </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nuevo nombre usuario</label>
                            <?php
                            $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

                            if ($connection->connect_errno) {
                                printf("Connection failed: %s\n", $connection->connect_error);
                                exit();
                            }
                                        if ($result = $connection->query("SELECT nombre_usuario
                                    FROM usuarios where idusuario='$a';")) {
                                    while($obj = $result->fetch_object()) {
                                    echo'<input type="text" name="nombreusu" class="form-control" placeholder="Nombre usuario actual: '.$obj->nombre_usuario.'" id="name"  required>';
                                    }
                                    $result->close();
                                    unset($obj);
                                    unset($connection);
                                  }
                                  ?>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nuevo email</label>
                            <?php
                            $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

                            if ($connection->connect_errno) {
                                printf("Connection failed: %s\n", $connection->connect_error);
                                exit();
                            }
                                        if ($result = $connection->query("SELECT email
                                    FROM usuarios where idusuario='$a';")) {
                                    while($obj = $result->fetch_object()) {
                                    echo'<input type="email" name="newemail" class="form-control" placeholder="Email actual: '.$obj->email.'" id="nemail" required>';
                                    }
                                    $result->close();
                                    unset($obj);
                                    unset($connection);
                                  }
                                  ?>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Nueva contraseña</label>
                            <?php
                            $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

                            if ($connection->connect_errno) {
                                printf("Connection failed: %s\n", $connection->connect_error);
                                exit();
                            }
                                        if ($result = $connection->query("SELECT password
                                    FROM usuarios where idusuario='$a';")) {
                                    while($obj = $result->fetch_object()) {
                                    echo'<input type="password" name="newpassword" class="form-control" placeholder="Nueva contraseña" id="npassword" required>';
                                    }
                                    $result->close();
                                    unset($obj);
                                    unset($connection);
                                  }
                                  ?>

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
       $connection2 = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
        if ($connection2->connect_errno) {
          printf("Connection failed: %s\n", $connection2->connect_error);
          exit();
          }
          $tipo= $_POST['edtipousu'];
          $username = $_POST['nombreusu'];
          $password = $_POST['newpassword'];
          $email = $_POST['newemail'];
          $cons="SELECT * FROM usuarios WHERE nombre_usuario = '$username'  OR email='$email' ";
          $result2  = $connection2->query($cons);
          if ($result2->num_rows==0) {
            if(isset($_POST['edtipousu']) && $_POST['edtipousu']!=="" ){
          $consulta= "UPDATE `usuarios` SET `tipo` = '$tipo'
           WHERE `usuarios`.`idusuario` = '$a' ";
          $result = $connection2->query($consulta);

           }
            if(isset($_POST['nombreusu']) && $_POST['nombreusu']!=="" ){
          if($_SESSION["id"]==$a){
            $_SESSION["username"]=$_POST['nombreusu'];
          }

          $consulta= "UPDATE `usuarios` SET `nombre_usuario` = '$username'
           WHERE `usuarios`.`idusuario` = '$a' ";
          $result = $connection2->query($consulta);
           }
          if(isset($_POST['newemail']) && $_POST['newemail']!=="" ){
            $consulta= "UPDATE `usuarios` SET `email` = '$email'
             WHERE `usuarios`.`idusuario` = '$a' ";
            $result = $connection2->query($consulta);
          }
          if(isset($_POST['newpassword']) && $_POST['newpassword']!=="" ){
            $consulta= "UPDATE `usuarios` SET `password` = md5('$password')
             WHERE `usuarios`.`idusuario` = '$a' ";
            $result = $connection2->query($consulta);
            }
            if (!$result) {
               echo "error";
            } else {
              echo "Datos cambiados";
              header("Refresh:2; url=paneladmin.php");
           }
          }else {
          echo "Esos datos están en uso";
          header("Refresh:2; url=index.php");
        }
        unset($connection2);
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
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>


    <!-- Theme JavaScript -->
    <script src="../js/clean-blog.min.js"></script>

    <!--Check password -->
    <script src="../js/checkpassed.js"></script>
