
<div class="col-lg-1">
  <div class="btn-group">
<button type="button" class="btn btn-default dropdown-toggle"
data-toggle="dropdown">
categorias <span class="caret"></span>
</button>
<ul class="dropdown-menu" rol=menu id="category">
<?php
$connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
} if ($result = $connection->query("SELECT *
    FROM categorias order by idcategoria;")) {
         while($obj = $result->fetch_object()) {
          echo "<li><a href='categorias.php?id=$obj->idCategoria'>$obj->valor</a><li>";
         }
         $result->close();
         unset($obj);
         unset($connection);
       }
?>
</ul>
</div>
</div>
