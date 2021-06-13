<?php
    if(!isset($_SESSION)){
        session_start();
    }


    $auth = $_SESSION['login'] ?? false;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <tittle></tittle>

    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
<header class="header ">
    <div class="contenido-header contenedor">
        <div class="titulo"><h1>Inventario</h1></div>
        <div class="contenedor-navegacion">
            <nav class="navegacion">
                <a href="vidrios-templados.php">Vidrios Templados</a>
                <a href="#">Accesorios</a>
                <a href="estuches.php">Estuches</a>
                <?php if($auth):?>
                <a href="crearusuario.php">Crear Usuario</a>
                <a href="cerrarsesion.php">Cerrar Sesion</a>

                <?php endif;?>
            </nav>
        </div>
    </div>
</header>