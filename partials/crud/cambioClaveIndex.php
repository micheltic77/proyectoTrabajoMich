<?php
    session_start();
    $sesion=$_SESSION["docid"];
    if(!isset($sesion)){
        header("location: ../../login/login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBOIPC</title>
    <link rel="stylesheet" href="../../estilos/estilosLog.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <!-- el usuario podra cambiar su clave mediante un formulario en donde debera de poner su 
    numero de identificacion para hacer la verificacion de que es el y debe de ingresar la nueva 
    contraseña en dos campos para saber si los dos campos son iguales  -->
    <div class="content">                                                                                  
        <div class="cont-formC">
            <h3>Cambiar Contraseña</h3>
            <form action="cambiarclave.php" method="POST" onsubmit="return validacionCont();">   
                <p>
                    <label>Cedula: </label>
                    <input type="text" name="doc_id" id="doc_id" value="<?php echo $sesion; ?>" require readonly>
                </p>
                <p>
                    <label>Nueva Contraseña</label>
                    <input type="password" name="pass" id="con1">
                </p>
                <p>
                    <label>Confirmar Contraseña</label>
                    <input type="password" name="pass2" id="con2">
                </p>
                <p class="block">
                    <button>
                        cambiar
                    </button>
                </p>
            </form>
        </div>
    </div>
    <script src="validacionCampos.js"></script>
</body>
</html>