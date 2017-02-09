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
                 if ($_SESSION["tipo"]){
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
    <header class="intro-header" style="background-image: url('img/perrito.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Añadir noticia</h1>
                        <hr class="small">
                        <span class="subheading">LOL</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if (!isset($_POST["categoria"])) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>Formulario añadir noticia</p>
                <form name="inisesion" id="sesion" novalidate method="post" enctype="multipart/form-data">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Titular</label>
                            <input type="text" class="form-control" name="titular" placeholder="Titular " id="titular" >
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Categoría</label>
                            <input type="number" class="form-control" name="categoria" placeholder="Categoría" id="categoria" >
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Cuerpo noticia</label>
                            <textarea rows="5" class="form-control" name="cuerpo" placeholder="Cuerpo noticia" id="cuerpo"></textarea>
                                <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Select image to upload:</label>
                            <input type="file" name="image" id="fileToUpload">
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
                //Temp file. Where the uploaded file is stored temporary
                $tmp_file = $_FILES['image']['tmp_name'];
                //Dir where we are going to store the file
                $target_dir = "img/";
                //Full name of the file.
                $target_file = strtolower($target_dir . basename($_FILES['image']['name']));
                //Can we upload the file
                $valid= true;
                //Check if the file already exists
                if (file_exists($target_file)) {
                  echo "Esa imagen ya está en el sistema.";
                  $valid = false;
                }
                //Check the size of the file. Up to 2Mb
                if ($_FILES['image']['size'] > (2048000)) {
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
                  //Put the file in its place
                  move_uploaded_file($tmp_file, $target_file);
                  //CREATING THE CONNECTION
                  $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                   //TESTING IF THE CONNECTION WAS RIGHT
                   if ($connection->connect_errno) {
                     printf("Connection failed: %s\n", $connection->connect_error);
                       exit();
                     }

                    $titular = $_POST['titular'];
                    $categoria = $_POST['categoria'];
                    $cuerpo = nl2br($_POST['cuerpo']);

            $consulta="INSERT INTO noticia (idNoticia,titular,cuerpo,fCreacion,
              fPublicacion,fModificacion,idUsuario,idCategoria,image)
             VALUES(NULL ,'$titular','$cuerpo',sysdate(),sysdate(),NULL,1,'$categoria','$target_file')";
  	        $result = $connection->query($consulta);
  	        if (!$result) {
   		         echo "Query Error";
               var_dump($consulta);
            } else {

              echo "<br/><br/><br/><h2>Tus datos han añadido correctamente en el sistema</h2>";
              header("Refresh:1; url=paneladmin.php");
              echo "<br/><br/>";
              echo "<a href='../'><h4 id='homeHeading'>Volver al panel</h4></a>";
              echo "<br/><br/>";

            }

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
