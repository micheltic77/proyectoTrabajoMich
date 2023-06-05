<?php 
    //pasar datos a variables
    $idContrato=$_POST['id_contrato'];
    $codContrato=$_POST['cod_contrato'];
    $fechaIni=$_POST['fecha_inicio'];
    $fechaTer=$_POST['fecha_terminacion'];
    $RegSireci=$_POST['veces_RegSireci'];
    $objContrato=$_POST['Obj_contrato'];
    $ModSeleccion=$_POST['Mod_seleccion'];
    $TipContrato=$_POST['Tipo_contrato'];
    $CodSecop=$_POST['Cod_secop'];
    $valorIni=$_POST['valorInit_contrato'];
    $tipoSegui=$_POST['Tipo_seguimiento'];
    $plazo=$_POST['plazo_contrato'];
    $pagoAnti=$_POST['pago_anticipado'];
    $adicion=$_POST['adiciones'];
    $obserbacion=$_POST['observaciones'];
    $numPoces=$_POST['num_proceso'];
    $linksecop=$_POST['link_secop'];
    $liderProsceso=$_POST['lider_proceso'];

    //llamar la base de datos
    require '../../confi/database.php';
    $db=new database(); 
    $con = $db->conectar();
    //se hace la consulta sql para actualizar
    $sql=$con->prepare("UPDATE contratos SET cod_contrato='$codContrato', fecha_inicio='$fechaIni', fecha_terminacion='$fechaTer', veces_RegSireci='$RegSireci', Obj_contrato='$objContrato', Mod_seleccion='$ModSeleccion', Tipo_contrato='$TipContrato', Cod_secop='$CodSecop', valorInit_contrato='$valorIni', Tipo_seguimiento='$tipoSegui', plazo_contrato='$plazo', pago_anticipado='$pagoAnti', adiciones='$adicion', observaciones='$obserbacion', num_proceso='$numPoces', link_secop='$linksecop', lider_proceso='$liderProsceso' WHERE id_contrato='$idContrato'");
    $sql->execute();

    if($sql){
        echo '<script>alert("Datos actualizados correctamente");
        window.location="../crud/datos.php";
        </script>';
    }else{
        echo '<script>alert("No se han podido modificar los datos, por favor vuelva a intentarlo mas tarde");
        window.location="../crud/datos.php";
        </script>';
    }
?>