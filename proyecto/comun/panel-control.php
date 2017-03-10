<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if ($_SESSION["tipo"]!=='comun'){
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

    <title>Noticias Gorgé - Contacto</title>

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
                        <h1>Panel de control</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                      <?php

                                     $user=$_SESSION['username'];
                                     $connection= new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                                      if ($connection->connect_errno) {
                                        printf("Connection failed: %s\n", $connection->connect_error);
                                        exit();
                                        }

                                     if ($result = $connection->query("SELECT *
                                        FROM usuarios where nombre_usuario='$user';")) {
                                         echo"<table style='border:1px solid black'>";
                                         echo"<thead>";
                                         echo"<tr>";
                                         echo"<th>Email </th>";
                                         echo"<th>Nombre usuario </th>";
                                         echo"<th>Fecha registro </th>";
                                         echo"<th>Editar datos </th>";
                                         echo"</thead>";
                                             while($obj = $result->fetch_object()) {
                                                 echo "<tr>";
                                                 echo "<td>".$obj->email."</td>";
                                                 echo "<td>".$obj->nombre_usuario."</td>";
                                                 echo "<td>".$obj->fecha_registro."</td>";
                                                 echo "<td>
                                                 <a href='editar.php?id=$obj->idUsuario'>
                                                 <i type='submit' class='glyphicon glyphicon-pencil' name='borrar'></i></a>
                                                 </td>";
                                                 echo "</tr>";
                                                 echo "</tr>";
                                             }
                                             $result->close();
                                             unset($obj);
                                             unset($connection);
                                           }
                      echo"</table>";
                      ?>
                    </div>
                    </div>
                    </div>
            </div>
        </div>
        <hr>

            <?php
            include("footer.php");
             ?>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>


    <!-- Theme JavaScript -->
    <script src="../js/clean-blog.min.js"></script>

</body>

</html>
