<?php

// Importar la conexión
require 'includes/app.php';
// $db = conectarDB();

// Crear el email y password
// $nombre = "Darwin Fernandez";
// $email = "admin@afterschool.org.pe";
// $passwor = "EQUeditor123ñ";
// $rol = 1;

//  $nombre = "Admin";
//  $email = "usuario@afterschool.org.pe";
//  $passwor = "EQUlector123ñ";
//  $rol = 2;

$nombre = "Pruebas";
$email = "correo@correo.com";
$passwor = "123";
$rol = 1;

$passworHash = password_hash($passwor, PASSWORD_BCRYPT);

// Query para crear el usuario
$query = " INSERT INTO usuario (nombre, email, passwor, rol) values('{$nombre}', '{$email}', '{$passworHash}', '{$rol}');";

// Agregar a la base de datos

$resultado = mysqli_query($db, $query);

if($resultado){
    debuguear("EL USUARIO SE CREO CORRECTAMENTE");
}else{
    debuguear("ERROR AL CREAR EL USUARIO, CONTACTE CON EL ADMINISTRADOR");
}
