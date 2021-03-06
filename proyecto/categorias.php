<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
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
  <?php
  include_once("header.php");
   ?>


    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/images.png')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Noticias Gorgè</h1>
                        <hr class="small">
                        <span class="subheading">Tu blog de noticias, y cada día
                        el de más gente</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
          <?php
          include_once("categoriaslist.php")
           ?>

            <div class="col-lg-9 col-lg-offset-2 col-md-10 col-md-offset-1">


                          <?php
                          $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

                          if ($connection->connect_errno) {
                              printf("Connection failed: %s\n", $connection->connect_error);
                              exit();
                          }
                                     if ($result = $connection->query("SELECT *
                                        FROM noticia join usuarios on noticia.idusuario
                                        =usuarios.idusuario where idcategoria='$a' order by idnoticia DESC ;" )) {
                                            if ($result->num_rows==0) {
                                              echo "No hay noticias en esta categoría";
                                            }else{
                                             while($obj = $result->fetch_object()) {
                                                 echo "<div class='post-preview'>";
                                                 echo "<h2 class='post-title'>";
                                                 echo "<a href='notcompleta.php?id=$obj->idNoticia'>$obj->titular</a>";
                                                 echo "</h2>";
                                                 echo "<img src=admin/$obj->image width=40% />";
                                                 echo "</div>";
                                                 if ($obj->fModificacion!=NULL) {
                                                   echo'<p class="post-meta">Escrita por '.$obj->nombre_usuario.' el '.$obj->fCreacion.'. Modificada el '.$obj->fModificacion.'</p>';
                                                 }else{
                                                   echo'<p class="post-meta">Escrita por '.$obj->nombre_usuario.' el '.$obj->fCreacion.'</p>';
                                                 }
                                                   }
                                             $result->close();
                                             unset($obj);
                                             unset($connection);
                                           }
                                         }
                            ?>
                        </h2>

                <hr>

            </div>
        </div>
    </div>

        <?php
        include("footer.php");
         ?>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
