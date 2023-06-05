<?php
    session_start();
    
    if(!isset($_SESSION["docid"]) ){
        header("location: ../login/login.php");
        exit;
    }
?> 
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Configuración</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fd9d79a2e5.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <a href="#" class="logo">
            <img src="../img/logosena.png" alt="logo del SENA">
            <h2 class="nombreempresa">SENA</h2>
        </a>
        <nav>
            <a href="index.php" class="nav-link">Inicio</a>
            <a href="alimentarBD/index.php" class="nav-link">Subir archivo</a>
            <a href="buscador/buscadorContratos.php" class="nav-link">Contratos</a>
        </nav>
    </header>
    <!-- boton que servira para descargar la base de datos -->

    <h1 class="title">Descargar Copia de Seguridad</h1>

    <a href="backup.php"><button class="button" style="vertical-align:middle"><span>Descargar</span></button></a>

</body>

</html>