<?php
    session_start();
    
    if(!isset($_SESSION["docid"]) ){
        header("location: ../login/login.php");
        exit;
    }
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
    <title>Inicio</title>
</head>

<body>
    <!-- hacemos la cabecera -->
    <header>
        <a href="#" class="logo">
            <img src="../img/logosena.png" alt="logo del SENA">
            <h2 class="nombreempresa">SENA</h2>
        </a>
        <nav>
            <a href="" class="nav-link">Inicio</a>
            <a href="alimentarBD/index.php" class="nav-link">Subir archivo</a>
            <a href="buscador/buscadorContratos.php" class="nav-link">Contratos</a>
        </nav>
    </header>
    <nav>
        <ul>
            <li style="--clr:#ffdd1c">
                <a href="buscador/buscadorContratos.php" data-text="&nbsp;contratos">&nbsp;Contratos&nbsp;</a>
            </li>
            <li style="--clr:#ff6492">
                <a href="copiaSeguridad.php" data-text="&nbsp;Database">&nbsp;Database&nbsp;</a>
            </li>
            <li style="--clr:#00dc82">
                <a href="../partials/logout.php" data-text="&nbsp;cerrar">&nbsp;Cerrar&nbsp;</a>
            </li>
            <p></p>
        </ul>
    </nav>
    
</body>

</html>