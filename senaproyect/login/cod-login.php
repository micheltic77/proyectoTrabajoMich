<?php
//conexion de la base de datos
//include '../confi/conexion.php';
//session_start();
//
//$docid_err="";
//$clave_err="";
//
//if (!empty(trim($_POST['docid']))) {
//echo("2");
//    if (!empty(trim($_POST['clave']))) {
//        echo("3");
//        $hostname = "localhost";
//        $database = "senaproyecto";
//        $username = "root";
//        $password = "";
//        $charset = "utf8";
//        $docid = $_POST['docid'];
//        $contraseña = hash_hmac($_POST['clave']);
//        echo($contraseña);
//        $con = mysqli_connect($hostname, $database, $username, $password, $charset);
//        $sql = "SELECT docid,email,nombre,apellidos,contraseña WHERE docid='" . $docid . "',contraseña='" . $contraseña . "'";
//        $query = mysqli_query($con, $sql);
//        $row = mysqli_num_rows($query);
//        var_dump($row);
//        if ($row == 1) {
//            echo("siuuuu");
//            //aca hace lo que quira guarda datos en las variables de secion y el location
//
//            header('Location: nav/index.php');
//        }
//    }else{
//        $clave_err="Ingrese una contraseña";
//    }
//}else{
//    $docid_err="Por favor ingrese el documento de identidad";
//}
//mysqli_close($con); //cierre de la conexion a la base de datos
//?>