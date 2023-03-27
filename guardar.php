<?php
        require 'conexion.php';
        $nombre   = $_POST['nombre'];
        $telefono = $_POST['telefono'];

        // Insertar el contacto en la base de datos
        $query = "INSERT INTO contactos (nombre, telefono)
                       VALUES ('$nombre', '$telefono') RETURNING id;";

        $res = pg_query($con, $query);

        if (pg_num_rows($res) != 0) {
            $fila = pg_fetch_array($res, 0);
            echo "Contacto guardado correctamente";
        } else {
            echo "Error al guardar el contacto";
        }

        // Cerrar la conexión a la base de datos
        pg_close($con);
    ?>
