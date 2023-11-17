<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');
define('RUTA_IMAGENES','http://localhost:3000/imagenes/');

function includeTemplate(string $nombre){
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado(): bool{
    session_start();

    if(!isset($_SESSION['id'])){
        return header('Location: /');
    }
    return false;
}

function debuguear($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

//Escapa / Sanitizar el html
function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

function validarTipoContenido($tipo){
    $tipos = ['blog', 'curso'];
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo){
    $mensaje = '';
    switch($codigo){
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;  
    }
    return $mensaje;
}

function validarORedireccionar(string $url){
    // Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        // Redireccionar al usuario
        header("Location: {$url}");
    }

    return $id;
}