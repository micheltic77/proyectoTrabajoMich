<?php
    session_start();
    $sesion=$_SESSION["docid"];
    if(!isset($sesion)){
        header("location: ../../login/login.php");
        exit;
    }
    require '../../confi/database.php';
    $db=new database();
    $con = $db->conectar();
    $sql=$con->prepare("SELECT docid, email, nombre, apellidos FROM usuario WHERE docid='$sesion'");
    $sql->execute();
    $resultado=$sql->fetch(PDO::FETCH_ASSOC);
    $docid=$resultado['docid'];
    $email=$resultado['email'];
    $nombre=$resultado['nombre'];
    $apellido=$resultado['apellidos'];

    if(!$sql){
        echo '<script>alert("Los datos no se pudieron cargar");
        window.location="../../nav/index.php";
        </script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBOIPC</title>
    <link rel="stylesheet" href="../../estilos/modificar.css">
    <script src="https://kit.fontawesome.com/fd9d79a2e5.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- utilizando un foreach se le presenta al usuario su informacion en un formulario 
  el cual puede ser modificado y esa informacion se enviara por post para realizar la consulta de update que modificara los datos -->
  <div class="container-all">
    <div class="ctn-form">
        <h1 class="title">Actualizar Datos</h1>
        <form action="actualizar.php" method="post">
            <label for="">Documento de Identidad</label>          
            <input type="text" name="docid" value="<?php echo $docid; ?>" readonly>

            <label for="">Email</label>          
            <input type="text" name="docid" value="<?php echo $email; ?>" readonly>

            <label for="">Nombre</label>          
            <input type="text" name="docid" value="<?php echo $nombre; ?>" readonly>

            <label for="">Apellidos</label>          
            <input type="text" name="docid" value="<?php echo $apellido; ?>" readonly>
        </form>
    </div>
  </div>
</body>
</html>