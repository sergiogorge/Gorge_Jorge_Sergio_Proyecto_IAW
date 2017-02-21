<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if ($_SESSION["tipo"]!=='admin'){
    session_destroy();
    header("Location:error.php");
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
                        <h1>Panel de control</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php

    //else
    echo'<div class="container">';
        echo'<div class="row">';
            echo'<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">';
                  echo'<div class="row control-group">';
                      echo'<div class="form-group col-xs-12 floating-label-form-group controls">';
                          echo '<h2>USUARIOS</h2>';
                          $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                          if ($connection->connect_errno) {
                              printf("Connection failed: %s\n", $connection->connect_error);
                              exit();
                          }
                                     $user=$_SESSION['username'];
                                     if ($result = $connection->query("SELECT *
                                        FROM usuarios;")) {
                                         echo"<table style='border:1px solid black'>";
                                         echo"<thead>";
                                         echo"<tr>";
                                         //echo"<th>ID </th>";
                                         echo"<th>Tipo </th>";
                                         echo"<th>Email </th>";
                                         echo"<th>Nombre usuario </th>";
                                         echo"<th>Fecha registro </th>";
                                         echo "<th>Borrar</th>";
                                         echo"</thead>";
                                             while($obj = $result->fetch_object()) {
                                                 echo "<tr>";
                                          //     echo "<td>".$obj->idUsuario."</td>";
                                                 echo "<td>".$obj->tipo."</td>";
                                                 echo "<td>".$obj->email."</td>";
                                                 echo "<td>".$obj->nombre_usuario."</td>";
                                                 echo "<td>".$obj->fecha_registro."</td>";
                                                 echo "<td>
                                                 <a href='borrar.php?id=$obj->idUsuario'>
                                                 <img src='borrar.jpg' width='30%';/>
                                               </a></td>";
                                                 echo "</tr>";
                                             }
                                             $result->close();
                                             unset($obj);
                                             unset($connection);
                                           }
                                          echo"</table>";
                      echo '</div>';
                    echo'</div>';
                    echo'</div>';
            echo'</div>';
        echo'</div>';
        echo '</br>';
  //    }
        ?>
        <?php

        //else{
        echo'<div class="container">';
            echo'<div class="row">';
                echo'<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">';
                      echo'<div class="row control-group">';
                         echo'<div class="form-group col-xs-12 floating-label-form-group controls">';
                              echo '<h2>NOTICIAS</h2>';
                              $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

                              if ($connection->connect_errno) {
                                  printf("Connection failed: %s\n", $connection->connect_error);
                                  exit();
                              }
                                         $user=$_SESSION['username'];
                                         if ($result = $connection->query("SELECT *
                                            FROM noticia;")) {
                                             echo"<table style='border:1px solid black'>";
                                             echo"<thead>";
                                             echo"<tr>";
                                             //echo"<th>ID </th>";
                                             echo"<th>ID </th>";
                                             echo"<th>Titular </th>";
                                             echo"<th>Fecha Creación </th>";
                                             echo"<th>Fecha Modificación </th>";
                                             echo "<th>Categoría</th>";
                                             echo "<th>Imagen</th>";
                                             echo "<th>Borrar</th>";
                                             echo "<th>Editar</th>";
                                            echo"</thead>";
                                                 while($obj = $result->fetch_object()) {
                                                     echo "<tr>";
                                                     echo "<td>".$obj->idNoticia."</td>";
                                                     echo "<td>".$obj->titular."</td>";
                                                     echo "<td>".$obj->fCreacion."</td>";
                                                     echo "<td>".$obj->fModificacion."</td>";
                                                     echo "<td>".$obj->idCategoria."</td>";
                                                     echo '<td><img src="'.$obj->image.'" width=40% /></td>';
                                                     echo "<td>
                                                     <a href='borrarnot.php?id=$obj->idNoticia'>
                                                     <img src='borrar.jpg' width='30%';/>
                                                   </a></td>";
                                                   echo "<td>
                                                   <a href='editar.php?id=$obj->idUsuario'>
                                                   <img src='edit.jpg' width='30%';/>
                                                 </a></td>";
                                                     echo "</tr>";
                                                 }
                                                 $result->close();
                                                 unset($obj);
                                                 unset($connection);
                                               }
                                              echo"</table>";
                          echo '</div>';
                        echo'</div>';
                        echo'</div>';
                echo'</div>';
            echo'</div>';
            echo '</br>';
      //    }
            ?>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <ul class="list-inline text-center">
                          <li>
                            <a href="registeradmin.php">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-child fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                                </li>
                            <li>
                                <a href="http://www.twitter.com/sergiogorge">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                              <a href="anadirnoticia.php">
                                  <span class="fa-stack fa-lg">
                                      <i class="fa fa-circle fa-stack-2x"></i>
                                      <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
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
