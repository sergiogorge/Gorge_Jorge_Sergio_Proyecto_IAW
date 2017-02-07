<?php

session_start();
unset ($SESSION['nombre']);
session_destroy();
var_dump("Sesión cerrada");

header('Location:http://localhost/Php/Sergio/proyecto/sesion.php');

?>
