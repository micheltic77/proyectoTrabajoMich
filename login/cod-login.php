<?php
    //activar sesion
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../nav/index.php");
    exit;
}
//conexion a la base de datos
require_once "../confi/conexion.php";

//variables vacias
$docid = $clave = "";
$docid_err = $clave_err = "";

if($_SERVER["REQUEST_METHOD"]=== "POST"){
    //se valida con un mensaje de error que los campos del documento y la clave no esten vacios
    if(empty(trim($_POST['docid']))){
        $docid_err = "Por favor ingrese el documento de identidad";
    }else{
        $docid=trim($_POST["docid"]);
    }
    
    if(empty(trim($_POST["clave"]))){
        $clave_err = "Ingrese la contraseña";
    }else{
        $clave = trim($_POST["clave"]);
    }
    
    //validacion de la informacion en la base de datos
    if(empty($docid) && !empty($clave)){
        $sql = "SELECT docid, email, nombre, apellidos, contraseña FROM usuario WHERE docid=?";

        if($stmt=mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_docid);

            $param_docid = $docid;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }

            if(mysqli_stmt_num_rows($stmt)==1){
                mysqli_stmt_bind_result($stmt, $docid,$email, $nombre, $apellido, $contraseña, $hashed_password);
                
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        session_start();

                        //ALMACENA VARIABLES DE SESION
                        $_SESSION["loggedin"] = true;
                        $_SESSION["docid"] = $docid;
                        $_SESSION["email"] = $email;

                        header("location: ../nav/index.php");
                    }else{
                        $clave_err = "la contraseña no es valida";
                    }
                }
            }else{
                $docid_err = "documento no registrado";
            }
        }
    }

    mysqli_close($link);//cierre de la base de datos
}
?>