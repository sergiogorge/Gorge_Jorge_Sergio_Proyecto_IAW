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
                        <h1>Editar foto</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <?php if (!isset($_POST["editimage"])) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>Editar foto</p>
                <form  name="foto" id="actfoto" novalidate method="post" enctype="multipart/form-data">
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Select image to upload:</label>
                          <input type="file" name="nimage" id="fileToUpload">
                        </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-xs-12">
                              <button type="submit" class="btn btn-default" name="editimage">Editar</button>
                          </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
  <?php else: ?>
    <?php
    $imagen="";
    $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }
               if ($result = $connection->query("SELECT noticia.*
                  FROM noticia;")) {
                       $obj = $result->fetch_object();
                       $imagen=$obj->image;

                       $result->close();
                       unset($obj);
                       unset($connection);
                     }
          //Temp file. Where the uploaded file is stored temporary
          $tmp_file = $_FILES['nimage']['tmp_name'];
          //Dir where we are going to store the file
          $target_dir = "imagenes/";
          //Full name of the file.
          $target_file = strtolower($target_dir . basename($_FILES['nimage']['name']));
          //Can we upload the file
          $valid= true;
          //Check if the file already exists
          if (file_exists($target_file)) {
            echo "Esa imagen ya está en el sistema.";
            $valid = false;
          }
          //Check the size of the file. Up to 2Mb
          if ($_FILES['nimage']['size'] > (2048000)) {
            $valid = false;
            echo 'Oops!  Your file\'s size is to large.';
          }
          //Check the file extension: We need an image not any other different type of file
          $file_extension = pathinfo($target_file, PATHINFO_EXTENSION); // We get the entension
          if ($file_extension!="jpg" && $file_extension!="jpeg" && $file_extension!="png" && $file_extension!="gif") {
            $valid = false;
            echo "Only JPG, JPEG, PNG & GIF files are allowed";
          }
          if ($valid) {
            unlink($imagen);
            //Put the file in its place
            move_uploaded_file($tmp_file, $target_file);
            //CREATING THE CONNECTION
            $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
             //TESTING IF THE CONNECTION WAS RIGHT
             if ($connection->connect_errno) {
               printf("Connection failed: %s\n", $connection->connect_error);
                 exit();
               }
      $consulta="UPDATE `noticia` SET `image` = '$target_file'
       WHERE `noticia`.`idnoticia` = '$a' ";
      $result = $connection->query($consulta);
      if (!$result) {
         echo "Query Error";
         var_dump($consulta);
      } else {
        echo "$imagen";
        echo "<br/><br/><br/><h2>La foto de la noticia se actualizó correctamente</h2>";
        header("Refresh:1; url=paneladmin.php");
        echo "<br/><br/>";
        //echo "<a href='../'><h4 id='homeHeading'>Volver al panel</h4></a>";
        echo "<br/><br/>";

      }

      }

      ?>

   <?php endif ?>
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
