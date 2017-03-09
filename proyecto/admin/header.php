<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="../index.php">Noticias Gorgé</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <?php
               echo '<a href="../index.php">Inicio</a>';
             ?>
            </li>

            <li>
                <?php
                if (isset($_SESSION["username"])){
                echo '<a href="../logout.php">Hola '.$_SESSION['username'].'.Cerrar sesión.</a>';
                } else {
                echo '<a href="../sesion.php">Iniciar sesión</a>';
                }
                ?>
              </li>    
           <li>
              <?php
              if (!isset($_SESSION["tipo"])){
             echo '<a href="../register.php">Registrarse.</a>';
             }else{
             if ($_SESSION["tipo"]=='admin'){
             echo '<a href="paneladmin.php">Panel de Control admin.</a>';
             }elseif ($_SESSION["tipo"]=='comun') {
             echo '<a href="../comun/panel-control.php">Panel de Control.</a>';
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
