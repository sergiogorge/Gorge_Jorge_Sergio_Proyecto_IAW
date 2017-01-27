      <?php
        //Realiza la conexión
        $connection = new mysqli("localhost", "tf", "12345", "proyecto_blog");
        //Que te diga el error si falla la conexión
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        //Con esto puedes poner tildes
        //  $connection->query("SET NAMES 'utf8'");
        ?>
