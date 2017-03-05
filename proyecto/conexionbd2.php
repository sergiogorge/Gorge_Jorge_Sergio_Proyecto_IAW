<?php
$connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");

if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
  }
    ?>
