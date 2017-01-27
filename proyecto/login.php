<?php
session_start();
?>

<?php
//conexion
$connection = new mysqli('localhost', 'tf', '12345', 'proyecto_blog');

//comprobación de errores
if ($connection->connect_error) {
 die("La conexion falló: " . $connection->connect_error);
}

//var_dump($_POST);

$username = $_POST['nombre'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$username' AND password=md5('$password')";

//echo $sql;

$result = $connection->query($sql);
$obj=$result->fetch_object();

if ($result->num_rows > 0) {

    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['tipo'] = $obj -> tipo;
    var_dump($sql);
    //$_SESSION['start'] = time();

    echo "Bienvenido " . $_SESSION['username'];
    echo "<br><br><a href=index.php>Ir al inicio</a>";

 } else {
   echo "Username o Password son incorrectos.";

   echo "<br><a href='sesion.php'>Volver a Intentarlo</a>";
 }
 mysqli_close($connection);
 ?>
