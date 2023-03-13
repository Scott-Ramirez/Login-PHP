<?php

    session_start();

    // Comprobamos si estamos logueado para que nos redireccione a la pagina principal 
    if (isset($_SESSION['user_id'])) {
        # code...
        header('Location: /php-login');
    }

    require_once 'database.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        # code...
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records-> bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = "";


        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            # code...
            $_SESSION['user_id'] = $results['id'];
            header('Location: /php-login');
        }else{
            $message = 'Sorry those credentials do not match ';
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/ico/contrasena.png" type="image/x-icon">
</head>
<body>
    <?php require_once "partials/header.php" ?>
    <!-- Mostrar mensaje en pantalla -->
    <?php if (!empty($message)): ?>
    <p class="bg-danger text-warning p-3 fw-bold fs-6"><?= $message ?></p>
    <?php endif;?>

    <h1>Iniciar Sesion</h1>
    <span>o<a class="btn btn-sm btn-primary" href="signup.php"> Registrarse</a></span>
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Ingresar su correo" required>
        <input type="password" name="password" placeholder="Ingresar su contraseña" required>
        <input type="submit" value="ACCEDER">
    </form>
</body>
</html>