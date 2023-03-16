<?php
    session_start();
    require_once 'database.php';

    if (isset($_SESSION['user_id'])) {
        # code...
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE id =:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records -> fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            # code...
            $user = $results;
        }
    } 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIENVENIDOS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/ico/home-automation.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <?php require_once "partials/header.php" ?>

    <!-- Mostrar datos del usuario en caso haya accedido  -->
    <?php if (!empty($user)): ?>
        <br><span class="fw-bold fs-3">Bienvenido</span> <span class="fw-bold text-danger fs-5" ><?= $user['email'] ?></span> 
        <br>Ahora puedes editar tu perfil para que otros usuarios puedan encontrarte más rapido <br><br>
        <a class="btn btn-md btn-primary fw-bold" href="perfil.php">Ir al Perfil</a> <br><br>
        <a class="btn btn-md btn-danger fw-bold" href="logout.php">Cerra Sesion</a>
    <?php else: ?>
        <!-- Mostrar pagina principal en caso de que no se haya accedido -->
        <br>
        <h1 class="fw-bold text-white">BIENVENIDO AL SISTEMA DE LOGIN 2023</h1>
        <br>
        <img src="assets/ico/navegador-web.png" alt="Security" > <br>
        <br>
        <a class=" btn btn-primary" href="login.php">ACCESO</a> o 
        <a class=" btn btn-primary" href="signup.php">REGÍSTRATE</a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#b58900" fill-opacity="1" d="M0,128L60,149.3C120,171,240,213,360,240C480,267,600,277,720,272C840,267,960,245,1080,208C1200,171,1320,117,1380,90.7L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
            <div class="bg-primary p-3 text-white fw-bold">
                <footer>©ScottRamirez-Todos los derechos reservados</footer>
            </div>
        </div>

    <?php endif; ?>
</body>
</html>