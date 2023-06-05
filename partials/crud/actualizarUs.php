<?php 
    //pasar datos a variables
    $docid=$_POST['docid'];
    $email=$_POST['email'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellidos'];

    //llamar la base de datosx
    require '../../confi/database.php';
    $db=new database();
    $con=$db->conectar();
    //se hace la consulta sql para actualizar   
    $sql=$con->prepare("UPDATE usuario SET email='$email', nombre='$nombre', apellido='$apellido' WHERE docid=$docid");
    $sql->execute();
    if ($sql) {
        echo '<script>alert("Datos actualizados correctamente");
        window.location="../crud/datosUs.php";
        </script>';
    }else{
        echo '<script>alert("No se han podido modificar los datos, por favor vuelva a intentarlo mas tarde");
        window.location="datosUs.php";
        </script>';
    }
?>