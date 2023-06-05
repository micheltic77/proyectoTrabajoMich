<?php
    require '../../confi/database.php';
    $db=new database();
    $con= $db->conectar();
    $documento=$_POST['doc_id'];
    $password=$_POST["pass"];
    $confimacion=$_POST['pass2'];
    //se hará la verificacion de que la contraseña y la sean iguales y se procede
    //a la encriptacion de la clave y se modificara en la base de datos

    if($password===$confimacion){
        $clave_encrypt= password_hash($password,PASSWORD_DEFAULT);
        $sql=$con->prepare("UPDATE usuario SET contraseña='$clave_encrypt' WHERE docid='$documento'");
        $sql->execute();

        if($sql){
            echo'
              <script>alert("Apreciado usuario su contraseña ha sido modificada");
              window.location="../../partials/logout.php";
              </script>
            ';
          }
    }else{
        echo '<script>alert("Las contraseñas no son iguales, por favor verifique");
        return false; 
        </script>';
    }
?>