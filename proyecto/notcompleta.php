<?php
ob_start();
?>
<?php
  session_start();
  if (empty($_GET))
  die("Tienes que pasar algun parametro por GET.");
  $a=$_GET['id'];
  $geturl=http_build_query($_GET);
?>
<!DOCTYPE html>
<html lang="en">
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
          include("categoriaslist.php");
           ?>
            <div class="col-lg-9 col-lg-offset-2 col-md-10 col-md-offset-1">
                          <?php
                          $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

                          if ($connection->connect_errno) {
                              printf("Connection failed: %s\n", $connection->connect_error);
                              exit();
                          }
                                     if ($result = $connection->query("SELECT *
                                        FROM noticia  join usuarios on noticia.idusuario
                                        =usuarios.idusuario where idnoticia='$a';")) {
                                             while($obj = $result->fetch_object()) {
                                               echo "<div class='post-preview'>";
                                                 echo "<h2 class='post-title'>";
                                                 echo "<a href='notcompleta.php?id=$obj->idNoticia'>$obj->titular</a>";
                                                echo "</h2>";
                                                 echo "<img src=admin/$obj->image width=40% />";
                                                 echo "</div>";
                                                 if($obj->fModificacion!=NULL) {
                                                   echo'<b><p class="post-meta">Escrita por '.$obj->nombre_usuario.' el '.$obj->fCreacion.'. Modificada el '.$obj->fModificacion.'</b></p>';
                                                   echo "<p class='text-justify'>$obj->cuerpo</p>";
                                                 }else{
                                                   echo'<b><p class="post-meta">Escrita por '.$obj->nombre_usuario.' el '.$obj->fCreacion.'</b></p>';
                                                   echo "<p class='text-justify'>$obj->cuerpo</p>";

                                                 }
                                               }
                                             $result->close();
                                             unset($obj);
                                           }
                                           echo "<h2>COMENTARIOS</h2>";
                                           $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                                           if ($connection->connect_errno) {
                                               printf("Connection failed: %s\n", $connection->connect_error);
                                               exit();
                                           }
                                           if ($result = $connection->query("SELECT *
                                              FROM comentarios join noticia on comentarios.idnoticia
                                              =noticia.idNoticia join usuarios on comentarios.idUsuario=usuarios.idusuario where noticia.idnoticia='$a' order by idcomentario DESC;")) {
                                                  if ($result->num_rows==0) {
                                                    echo "No hay comenarios";
                                                    echo "<br>";
                                                  }else{
                                                   while($obj = $result->fetch_object()) {
                                                      echo "$obj->comentario";
                                                       if(isset($_SESSION["tipo"])){
                                                         if($_SESSION["id"]==$obj->idUsuario || $_SESSION["tipo"]=='admin'){
                                                           echo"<a href='borrar/borrarcom.php?id=$obj->idComentario'>
                                                           <i type='submit' class='glyphicon glyphicon-trash' name='borrar'></i></a>";
                                                         }
                                                       }
                                                         echo'<b><p class="post-meta">Escrito por '.$obj->nombre_usuario.' el '.$obj->fCreacionC.'</b></p>';
                                                      }
                                                   $result->close();
                                                   unset($obj);
                                                 }
                                               }
                                               echo "<h2>NOTA MEDIA</h2>";
                                                $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                                               if ($connection->connect_errno) {
                                                   printf("Connection failed: %s\n", $connection->connect_error);
                                                   exit();
                                             }

                                                          if ($result = $connection->query("SELECT avg(nota) as medianota, idnoticia
                                                          from valoraciones where idnoticia='$a' ;")) {
                                                               while($obj = $result->fetch_object()) {
                                                                 if ($obj->medianota=="") {
                                                                  echo"No hay valoraciones";
                                                                }else{
                                                                 echo"La nota media de esta noticia es: $obj->medianota";
                                                                 echo "<br>";
                                                                  }
                                                                  if (isset($_SESSION["tipo"])){
                                                                  if ($_SESSION["tipo"]=='admin'){
                                                                    echo"<p>Resetear valoraciones<a href='admin/borrar/borrarval.php?id=$obj->idnoticia'>
                                                                    <i type='submit' class='glyphicon glyphicon-trash' name='borrar'></i></a></p>";
                                                                 }else{

                                                                 }
                                                               }
                   }
                                                                  $result->close();
                                                                  unset($obj);

                                                                }
                                                   if (isset($_SESSION["tipo"])){
                                                     echo '<h2>AÑADIR COMENTARIO</h2>';
                                                     echo '<form name="comentario" id="comentar" novalidate method="post">';
                                                     echo'<div class="row control-group">';
                                                     echo'<div class="form-group col-xs-12 floating-label-form-group controls">';
                                                     echo'<textarea rows="5" class="form-control" name="com"
                                                      placeholder="Comentario..." id="comentario"
                                                   required></textarea>';
                                                     echo'<p class="help-block text-danger"></p>';
                                                     echo'</div>';
                                                     echo'</div>';
                                                     echo'<button type="submit" class="btn btn-default" name="comentar">Enviar comentario</button>';
                                                     if (isset($_POST["comentar"])){
                                                       $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                                                        if ($connection->connect_errno) {
                                                          printf("Connection failed: %s\n", $connection->connect_error);
                                                          exit();
                                                          }
                                                       $com= nl2br($_POST["com"]);
                                                       $user=$_SESSION["id"];
                                                       $consulta= "INSERT INTO comentarios (idcomentario,idnoticia,idusuario,comentario,fcreacionc)
                                                       VALUES (NULL,'$a','$user','$com',sysdate())";
                                                       $result = $connection->query($consulta);
                                                       if (!$result) {
                                                          echo "error";
                                                       } else {
                                                         header('Location:notcompleta.php'."?".$geturl);
                                                        }
                                                     }
                                                     echo '<h2>VALORAR</h2>';
                                                     echo '<form  name="valorar" id="valorar" novalidate method="post">';
                                                     echo'<div class="row control-group">';
                                                         echo'<div class="form-group col-xs-12 floating-label-form-group controls">';
                                                           echo'<select name="val">';
                                                                echo'<option>0</option>';
                                                                echo'<option>1</option>';
                                                                echo'<option>2</option>';
                                                                echo'<option>3</option>';
                                                                echo'<option>4</option>';
                                                                echo'<option>5</option>';
                                                                echo'<option>6</option>';
                                                                echo'<option>7</option>';
                                                                echo'<option>8</option>';
                                                                echo'<option>9</option>';
                                                                echo'<option>10</option>';
                                                              echo'</select><br/><br/>';
                                                              echo'<p class="help-block text-danger"></p>';
                                                              echo'<button type="submit" class="btn btn-default" name="valorar">Valorar</button>';
                                                              echo '</div>';
                                                              echo '</div>';
                                                      if (isset($_POST["valorar"])){
                                                        $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                                                         if ($connection->connect_errno) {
                                                           printf("Connection failed: %s\n", $connection->connect_error);
                                                           exit();
                                                           }
                                                        $val= $_POST["val"];
                                                        $user=$_SESSION["id"];
                                                        $cons= "INSERT INTO valoraciones (idvaloracion,idnoticia,idusuario,nota,fvaloracion)
                                                        VALUES (NULL,'$a','$user','$val',sysdate())";
                                                        $result= $connection->query($cons);
                                                        if (!$result) {
                                                           echo "error";
                                                        } else {
                                                          header('Location:notcompleta.php'."?".$geturl);
                                                         }
                                                         }
                                                       }else{
                                                         echo "<a href=sesion.php>Inicia sesión</a> para valorar y comentar";
                                                         echo "<br>";
                                                       }
                                                       unset($connection);

                            ?>

                </div>
                <hr>
        </div>
    </div>
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
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
<?php
ob_end_flush();
?>
