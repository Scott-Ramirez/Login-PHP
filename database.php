<?php
    $server = 'localhost';
    $username= 'root';
    $password ='';
    $database ='php_login_database';

    try {
        //conexion a la base de datos 
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
    } catch (PDOException $e) {
        die('Connected failed: '.$e->getMessage());
    }

?>