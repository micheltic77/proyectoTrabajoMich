<?php
  require 'cod-login.php'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/estiloslog.css">
    <script src="https://kit.fontawesome.com/4630896a4b.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
    <title>Ingresar</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <div class="cont-all">
        <div class="cont-form">
            <h1 class="title">Inicia sesion</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input class="inputs" type="text" name="docid" pattern="{5-12}" placeholder="Número de Documento">
                <span class="msg-error"><?php echo $docid_err; ?></span>

                <input class="inputs" type="password" name="contraseña" pattern="[a-zA-Z0-9\_\#\-]{8, 16}" placeholder="Ingrese su Contraseña">
                <span class="msg-error"> <?php echo $clave_err; ?></span> 
                <div class="contOjo"><i class="fa-solid fa-eye" id="ojo"></i></div>

                <input type="submit" value="Ingresar">
            </form>
            <span class="text-footer">¿No tienes cuenta?
                <a href="registrar.php">Regristrate</a>
            </span>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <!--se trae el script para mostrar la contraseña-->
    <script src="../script/verContraseña.js"></script>
    </div>
    
</body>
</html>