<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php
        $login      = obtener_post('login');
        $password   = obtener_post('password');

        $clases_label = '';
        $clases_input = '';
        $error = false;

        if(isset($login, $password)) {
            if ($usuario = \App\Tablas\Usuario::comprobar($login, $password)) {
                if (!$usuario->validado) {
                    $_SESSION['error'] = 'El usuario no está validado.';
                    return volver();
                }

                $_SESSION['login'] = serialize($usuario);
                return $usuario->es_admin() ? volver_admin() : volver();
            } else {
                $error = true;
            }
        }
    ?>
    <div>
        <form action="" method="POST">
            <div>
                <label for="login"class= "<?= $clases_label ?>">Nombre de usuario</label>
                <input type="text" name="login" class= "<?= $clases_input ?>">
                <?php if ($error): ?>
                    <p> Error!! Nombre de usuario o contraseña incorrectos</p>
                <?php endif ?>
            </div>

            <div>
                <label for="password"class= "<?= $clases_label ?>">Contraseña</label>
                <input type="password" name="password" class= "<?= $clases_input ?>">
                <?php if ($error): ?>
                    <p> Error!! Nombre de usuario o contraseña incorrectos</p>
                <?php endif ?>
            </div>

            <button type="submit">Login</button>
            <a href="/registrar.php">Registrar</a>
        </form>
    </div>
</body>
</html>
