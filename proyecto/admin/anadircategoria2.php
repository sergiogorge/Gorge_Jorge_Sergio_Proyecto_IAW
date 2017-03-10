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
    <header class="intro-header" style="background-image: url('../img/perrito.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Añadir categoría</h1>
                        <hr class="small">
                        <span class="subheading">LOL</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if (!isset($_POST["ncategoria"])) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>Formulario añadir categoria</p>
                <form name="inisesion" id="sesion" novalidate method="post" enctype="multipart/form-data">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Categoria</label>
                            <input type="text" class="form-control" name="ncategoria" placeholder="Categoria " id="categoria" >
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
 $categoria=$_POST["ncategoria"];
$cons="SELECT * FROM categorias WHERE valor = '$categoria'";
$result2  = $connection->query($cons);
if ($result2->num_rows==0) {

            $consulta="INSERT INTO categorias (idCategoria,valor)
             VALUES(NULL ,'$categoria')";
  	        $result = $connection->query($consulta);
  	        if (!$result) {
   		         echo "Query Error";
               var_dump($consulta);
            } else {

              echo "<br/><br/><br/><h2>Categoría añadida correctamente en el sistema</h2>";
              header("Refresh:1; url=paneladmin.php");
              echo "<br/><br/>";
              //echo "<a href='../'><h4 id='homeHeading'>Volver al panel</h4></a>";
              echo "<br/><br/>";

            }
}else{
  echo "Esa categoria ya existe";
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
