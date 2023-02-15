<?php
    session_start();

    $docid_err="";
    $clave_err="";
    
    if (!empty($_POST['docid'])) {
    echo"2";
        if (!empty(trim($_POST['clave']))) {
            echo"3";
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $database = "senaproyecto";
            $docid = $_POST['docid'];
            $contraseña = hash_hmac("sha1",$_POST['clave'],"pass");
            echo$contraseña;
            $con = mysqli_connect($hostname, $username, $password, $database);
            $sql = "SELECT docid,email,nombre,apellidos,contraseña WHERE docid='" . $docid . "',contraseña='" . $contraseña . "'";
            $query = mysqli_query($con, $sql);
            $row = mysqli_num_rows($query);
            var_dump($row);
            if ($row == 1) {
                echo"siuuuu";
                //aca hace lo que quira guarda datos en las variables de secion y el location
    
                header('Location: nav/index.php');
            }
        }else{
            $clave_err="Ingrese una contraseña";
        }
    }else{
        $docid_err="Por favor ingrese el documento de identidad";
    }
    //mysqli_close($con); //cierre de la conexion a la base de datos
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
            <form action="" method="post">
                <input class="inputs" type="text" name="docid" placeholder="Número de Documento">
                <!-- <span class="msg-error"><?php echo $docid; ?></span> -->

                <input class="inputs" type="password" name="clave" placeholder="Ingrese su Contraseña">
                <!-- <span class="msg-error"> <?php echo $clave; ?></span>  -->
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