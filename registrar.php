<?php

use App\Tablas\Usuario;

session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<body>
    <?php

    $login = obtener_post('login');
    $password = obtener_post('password');
    $password_repeat = obtener_post('password_repeat');

    $clases_label = [];
    $clases_input = [];
    $error = ['login' => [], 'password' => [], 'password_repeat' => []];

    foreach(['login', 'password', 'password_repeat'] as $e) {
        $clases_label[$e] = '';
        $clases_input[$e] = '';
    }

    if (isset($login, $password, $password_repeat)) {
        $pdo = conectar();

        if ($login == '') {
            $error['login'][] = 'El usuario es obligatorio.';
        } else if (mb_strlen($login) > 20) {
            $error['login'][] = 'El nombre de usuario es demasiado largo.';
        } else if (\App\Tablas\Usuario::existe($login, $pdo)) {
            $error['login'][] = 'El usuario ya existe.';
        }

        if ($password != $password_repeat) {
            $error['password'][] = 'Las contraseñas no coinciden.';
        }

        if ($password == '') {
            $error['password'][] = 'La contraseña es obligatoria.';
        }

        if ($password_repeat == '') {
            $error['password_repeat'][] = 'La contraseña es obligatoria.';
        }

        if (preg_match('/[a-z]/', $password) !== 1) {
            $error['password'][] = 'Debe contener al menos una minúscula.';
        }

        if (preg_match('/[A-Z]/', $password) !== 1) {
            $error['password'][] = 'Debe contener al menos una mayúscula.';
        }

        if (preg_match('/[[:digit:]]/', $password) !== 1) {
            $error['password'][] = 'Debe contener al menos un dígito.';
        }

        if (preg_match('/[[:punct:]]/', $password) !== 1) {
            $error['password'][] = 'Debe contener al menos un signo de puntuación.';
        }

        if (mb_strlen($password) < 8) {
            $error['password'][] = 'Debe tener al menos 8 caracteres.';
        }

        $vacio = true;

        foreach ($error as $err) {
            if (!empty($err)) {
                $vacio = false;
                break;
            }
        }

        if ($vacio) {
            // Registrar
            Usuario::registrar($login, $password, $pdo);
            $_SESSION['exito'] = 'El usuario se ha registrado correctamente.';
            return redirigir_login();
        }
    }
    ?>
    <form action="" method="POST">
        <div>
            <label for="login" class="<?= $clases_label['login'] ?>">Nombre de usuario</label>
            <input type="text" name="login" id="login" class="<?= $clases_input['login'] ?>">
            <?php foreach ($error['login'] as $err): ?>
                <p><span class="font-bold">Error!!<?= $err ?></p>
            <?php endforeach ?>
        </div>
        <div>
            <label for="password" class="<?= $clases_label['password'] ?>">Contraseña</label>
            <input type="password" name="password" id="password" class="<?= $clases_input['password'] ?>">
            <?php foreach ($error['password'] as $err): ?>
                <p><span class="font-bold">Error!!<?= $err ?></p>
            <?php endforeach ?>
        </div>

        <div>
            <label for="password_repeat" class="<?= $clases_label['password_repeat'] ?>">Confirmar Contraseña</label>
            <input type="password" name="password_repeat" id="password_repeat" class="<?= $clases_input['password_repeat'] ?>">
            <?php foreach ($error['password_repeat'] as $err): ?>
                <p><span class="font-bold">Error!!<?= $err ?></p>
            <?php endforeach ?>
        </div>
        <button type="submit"> Registrar </button>
    </form>
</body>
</html>
