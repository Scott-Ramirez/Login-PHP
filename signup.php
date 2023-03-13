<?php
    require_once "database.php";
    $message = '';
    // Si detecta que los campos no estan vacios, procede a agrear los datos a la BD
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        # code...
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            # code...
            $message='Successfully created new user';
        }else{
            $message='Sorry there must have been an issue creating your acount ';
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/ico/signup.png" type="image/x-icon">
</head>
<body>
    <?php require_once "partials/header.php" ?>
    <!-- Mostrar mensaje en pantalla -->
    <?php if (!empty($message)): ?>
    <p class="bg-success text-white p-3 fw-bold fs-6"><?= $message ?></p>
    <?php endif;?>

    <h1>Registro</h1>
    <span>o<a class="btn btn-sm btn-primary"href="login.php"> Iniciar Sesion</a></span>
    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Ingresar un correo" required>
        <input type="password" name="password" placeholder="Ingresar una contraseña" required>
        <input type="password" name="confirm_password" placeholder="Confirmar contraseña" required>
        <input type="submit" value="REGISTRAR">
    </form>

    
</body>
</html>