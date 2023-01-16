<?php
include 'cod-registrar.php';
require '../confi/database.php';
$db = new database();
$conexion = $db->conectar();
//

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/4630896a4b.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilos/estilosReg.css">
    <title>Login</title>
</head>

<body>

    <!-- se crea un formulario donde se le piden los datos personales al usuario para ser registrado -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <div class="container-all">
        <div class="cont-form">
            <h1 class="titulo">Registrate</h1>

            <form action="registrar.php" method="post">
                <input  class="inputs" type="text" name="docid" placeholder="Número de Documento">
                <span class="msg-error"><?php echo $docid_err; ?></span>

                <input  class="inputs" type="text" name="email" placeholder="Correo Electronico">
                <span class="msg-error"><?php echo $email_err; ?></span>

                <input  class="inputs" type="text" name="usuario" placeholder="Nombres">
                <span class="msg-error"><?php echo $usuario_err; ?></span>

                <input  class="inputs" type="text" name="apellido" placeholder="Apellidos">
                <span class="msg-error"><?php echo $apellido_err; ?></span>

                <input  class="inputs" type="password" name="contraseña" id="pass" placeholder="Ingrese Su Contraseña">
                <div class="contOjo"><i class="fa-solid fa-eye" id="ojo"></i></div><span class="msg-error"><?php echo $contraseña_err; ?></span>

                <input class="inputs input-confir"  type="password" name="confir_contraseña" id="confPass" placeholder="Confirmar Su Contraseña">
                <div class="contOjo"><i class="fa-solid fa-eye" id="ojoC"></i></div><span class="msg-error"></span>

                <input type="submit" value="Registrarse">
            </form>
            <span class="text-footer">¿Ya tienes cuenta?
                <a href="login.php">Iniciar Sesion</a>
            </span>
        </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <!--se trae el script para mostrar la contraseña-->
    <script src="../script/verContraseña.js"></script>
    </div>
    
</body>

</html>