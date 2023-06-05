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
    $id_contrato = $_GET['id_contrato'];
    $sql=$con->prepare("SELECT cod_contrato,fecha_inicio,fecha_terminacion,veces_RegSireci,obj_contrato,Mod_seleccion,Tipo_contrato,Cod_secop,valorInit_contrato,Tipo_seguimiento,plazo_contrato,pago_anticipado,adiciones,observaciones,num_proceso,link_secop,lider_proceso
    FROM contratos
    WHERE id_contrato=$id_contrato");
    $sql->execute();
    $resultado=$sql->fetch(PDO::FETCH_ASSOC);
    $codContrato=$resultado['cod_contrato'];
    $fechaInicio=$resultado['fecha_inicio'];
    $fechaTerminacion=$resultado['fecha_terminacion'];
    $sireci=$resultado['veces_RegSireci'];
    $objeto=$resultado['obj_contrato'];
    $modSeleccion=$resultado['Mod_seleccion'];
    $tipoContrato=$resultado['Tipo_contrato'];
    $codSecop=$resultado['Cod_secop'];
    $valorInicial=$resultado['valorInit_contrato'];
    $seguimiento=$resultado['Tipo_seguimiento'];
    $plazoContrato=$resultado['plazo_contrato'];
    $pagoAnticipado=$resultado['pago_anticipado'];
    $adicion=$resultado['adiciones'];
    $observacion=$resultado['observaciones'];
    $numProceso=$resultado['num_proceso'];
    $linkSecop=$resultado['link_secop'];
    $liderProceso=$resultado['lider_proceso'];
    
    $ordGasto=$con->prepare("SELECT * FROM ordenadorgasto ORDER BY nombreOrdenadorG ASC");
    $ordGasto->execute();
    $nombreOrdenador=$ordGasto->fetchAll(PDO::FETCH_ASSOC);

    $regional=$con->prepare("SELECT regional.id_regional, regional.nombre_regional, centro.nombre_centro FROM regional INNER JOIN centro ON regional.centro=centro.centro_id;");
    $regional->execute();
    $regionalNombre=$regional->fetchAll(PDO::FETCH_ASSOC);
     
    $contratista=$con->prepare("SELECT * FROM contratista ORDER BY Nombre_contr ASC");
    $contratista->execute();
    $contratistaNombre=$contratista->fetchAll(PDO::FETCH_ASSOC);

    $garantia=$con->prepare("SELECT * FROM garantias ORDER BY tipo_garantia");
    $garantia->execute();
    $tipogarantia=$garantia->fetchAll(PDO::FETCH_ASSOC);

    $supervisores=$con->prepare("SELECT * FROM supervisores ORDER BY nombreSupervisor");
    $supervisores->execute();
    $supervisor=$supervisores->fetchAll(PDO::FETCH_ASSOC);

    if(!$sql){
        echo '<script>alert("Los datos no se pudieron cargar");
        window.location="../../administrador/index.php";
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
        <h1 class="title">Actualizar Datos de Contrato</h1>
        <form action="actualizar.php" method="post">
            <label for="">Codigo del Contrato</label>          
            <input type="text" name="codcontra" value="<?php echo $codContrato; ?>" readonly>

            <label for="">Fecha de Inicio</label>          
            <input type="text" name="fechaIni" value="<?php echo $fechaInicio; ?>" readonly>

            <label for="">Fecha de Terminacion</label>          
            <input type="text" name="fechaTer" value="<?php echo $fechaTerminacion; ?>" readonly>

            <label for="">Ordenador de Gasto</label>
            <select name="ordGasto" class="select">
                <?php foreach($nombreOrdenador as $Gasto){ ?>
                <option value="<?php echo $Gasto['docidOrd']; ?>"><?php echo $Gasto['nombreOrdenadorG'];?></option>
                <?php }?>
            </select>

            <label for="">Regional</label>
            <select name="region" class="select">
                <?php foreach($regionalNombre as $regionaS){ ?>
                <option value="<?php echo $regionaS['id_regional']; ?>"><?php echo $regionaS['nombre_regional'];?></option>
                <?php }?>
            </select>

            <label for="">Cantidad Veces Registrado en Sireci</label>          
            <input type="text" name="sireci" value="<?php echo $sireci; ?>" readonly>

            <label for="">Objeto del Contrato</label>          
            <input type="text" name="objeto" value="<?php echo $objeto; ?>" readonly>

            <label for="">Modalidad de Seleccion</label>          
            <input type="text" name="ModSelec" value="<?php echo $modSeleccion; ?>" readonly>

            <label for="">Tipo de Contrato</label>          
            <input type="text" name="TipoCo" value="<?php echo $tipoContrato; ?>" readonly>

            <label for="">Codigo de Secop</label>
            <input type="text" name="secop" value="<?php echo $codSecop; ?>" readonly>

            <label for="">Valor Inicial del Contrato</label>          
            <input type="text" name="Vinicial" value="<?php echo $valorInicial; ?>" readonly>

            <label for="">Contratista</label>
            <select name="contratista" class="select">
                <?php foreach($contratistaNombre as $contra){ ?>
                <option value="<?php echo $contra['Nit_contratista']; ?>"><?php echo $contra['Nombre_contr'];?></option>
                <?php }?>
            </select>

            <label for="">Garantia</label>
            <select name="garantias" class="select">
                <?php foreach($tipogarantia as $garant){ ?>
                <option value="<?php echo $garant['cod_garant']; ?>"><?php echo $garant['tipo_garantia'];?></option>
                <?php }?>
            </select>

            <label for="">Tipo de Seguimiento</label>
            <input type="text" name="tpSeguimiento" value="<?php echo $seguimiento; ?>" readonly>

            <select name="supervisor" class="select">
                <?php foreach($supervisor as $superv){ ?>
                <option value="<?php echo $superv['docid_supervisor']; ?>"><?php echo $superv['nombreSupervisor'];?></option>
                <?php }?>
            </select>

            <label for="">Plazo Contrato</label>
            <input type="text" name="pContratoc" value="<?php echo $seguimiento; ?>" readonly>

            <label for="">Pago Anticipado</label>
            <input type="text" name="pagoAnticipadp" value="<?php echo $pagoAnticipado; ?>" readonly>

            <label for="">adiciones</label>
            <input type="text" name="adicion" value="<?php echo $adicion; ?>" readonly>

            <label for="">Observaciones</label>
            <input type="text" name="observac" value="<?php echo $observacion?>" readonly>

            <label for="">Numero de Proceso</label>
            <input type="text" name="numPro" value="<?php echo $numProceso?>" readonly>

            <label for="">Link del Contrato</label>
            <input type="text" name="linkSec" value="<?php echo $linkSecop?>" readonly>

            <label for="">Lider del Proceso</label>
            <input type="text" name="lider" value="<?php echo $liderProceso?>">
        </form>
    </div>
  </div>
</body>
</html>