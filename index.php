<?php
    use App\Tablas\Usuario;
    session_start();
    require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>
<body>
    <?php
    echo Usuario::esta_logueado();
    if(!$log){
        header('Location: /login.php');
        exit();
    }
    ?>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <h1>Guardar contacto</h1>
        <form action="guardar.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
            <br>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" required>
            <br>
            <input type="submit" value="Guardar">
        </form>
    <?php endif ?>
</body>
</html>
