<?php

// Incluir archivo de conexion a la base de datos
require_once "../confi/conexion.php";

// Definir variable e inicializar con valores vacio
$docid = $email = $usuario = $apellido = $contraseña = "";
$docid_err = $email_err = $usuario_err = $apellido_err = $contraseña_err = $check_err = "";
//variable de checkbox


//en el momento de precionar el boton registrarse se validan los campos
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // VALIDANDO INPUT DE documento
    if (empty(trim($_POST["docid"]))) {
        $docid_err = "Por favor, ingrese su documento de identidad";
    } else {
        //consulta sql
        $sql = "SELECT * FROM usuario WHERE docid = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_docid);

            $param_docid = trim($_POST["docid"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $docid_err = "Este documento  ya está en uso";
                } else {
                    $docid = trim($_POST["docid"]);
                }
            } else {
                echo '<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
            }
        }
    }

    //VALIDANDO EL CORREO ELECTRONICO
    if (empty((trim($_POST["email"])))) {
        $email_err = "Por favor, ingrese su correo electronico";
    } else {
        //consulta sql
        $sql = "SELECT * FROM usuario WHERE email=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $docid_err = "Este correo  ya está en uso";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo '<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                return false;
                </script>';
            }
        }
    }

    // VALIDANDO INPUT DE NOMBRE DE USUARIO
    if (empty(trim($_POST["usuario"]))) {
        $nombre_err = "Por favor, ingrese su nombre";
    } else {
        //consulta sql
        $sql = "SELECT * FROM usuario WHERE nombre= ?";
        //sentencia preparada
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_nombre);

            $param_nombre = trim($_POST["usuario"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $nombre = trim($_POST["usuario"]);
            } else {
                echo '<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
            }
        }
    }

    // VALIDANDO INPUT DE APELLIDO
    if (empty(trim($_POST["apellido"]))) {
        $apellido_err = "Por favor, ingrese sus apellidos";
    } else {
        //consulta sql
        $sql = "SELECT * FROM usuario WHERE apellidos= ?";
        //sentencia preparada
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_apellido);

            $param_apellido = trim($_POST["apellido"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $apellido = trim($_POST["apellido"]);
            } else {
                echo '<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
            }
        }
    }

    //VALIDANDO CONTRASEÑAS IGUALES
    if ($_POST["contraseña"] == $_POST["confir_contraseña"]) {
        // VALIDANDO CONTRASEÑA
        if (empty(trim($_POST["contraseña"]))) {
            $contraseña_err = "Por favor, ingrese una contraseña";
        } elseif (strlen(trim($_POST["contraseña"])) < 8) {
            $contraseña_err = "La contraseña debe de tener al menos 8 caracteres";
        } elseif (mysqli_stmt_num_rows($stmt) == 1) {
            $contraseña_err = "Digite otra contraseña diferente";
        } else {
            $contraseña = trim($_POST["contraseña"]);
        }
    } else {
        $contraseña_err = "Las contraseñas no coinciden";
    }

    // COMPROBANDO LOS ERRORES DE ENTRADA ANTES DE INSERTAR LOS DATOS EN LA BASE DE DATOS
    if (!empty($docid) && !empty($email) && !empty($nombre) && !empty($apellido) && !empty($contraseña)) {

        $sql = "INSERT INTO usuario(docid, email, nombre, apellidos, contraseña) VALUES(?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $param_docid, $param_email, $param_nombre, $param_apellido, $param_contraseña);

            // ESTABLECIENDO PARAMETRO
            $param_docid = $docid;
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_email = $email;
            //encriptando la contraseña
            $param_contraseña = hash_hmac("sha1",$contraseña,"pass");

            if (mysqli_stmt_execute($stmt)) {
                echo '
                     <script>alert("Gracias por registrarse");
                     window.location="login.php";
                     </script>
                    ';
            } else {
                echo '<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
            }
        }


    }

    mysqli_close($link); //cierre de la base de datos

} //cierre de request

?>