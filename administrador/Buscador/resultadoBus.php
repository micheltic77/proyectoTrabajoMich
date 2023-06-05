<?php 
    session_start();
    $sesion=$_SESSION["docid"];
    if(!isset($sesion)){
        header("location: ../../login/login.php");
        exit;
    }

    require '../../confi/token.php';
    require '../../confi/database.php';

    $bd=new database();
    $con= $bd->conectar();

    //se usa el id del contrato y el token en el get
    $id=isset($_GET['id']) ? $_GET['id'] : '';
    $token=isset($_GET['token']) ? $_GET['token'] : '';

    //verifica el id y el token que no estén vacios
    if($id=='' || $token==''){
        echo'error al hacer la peticion'; 
        exit; 
    }else{
      /*se configura para que no puedan modificar el token 
      si se le cambia alguna letra o numero este mostrara error*/
      $token_tmp=hash_hmac('sha1', $id, KEY_TOKEN);
      if($token==$token_tmp){
        $sql=$con->prepare("SELECT count(id_contrato) FROM contratos where id_contrato=?");
        $sql->execute([$id]);
        if($sql->fetchColumn() > 0){
          $sql=$con->prepare("SELECT contratos.id_contrato as idc,contratos.cod_contrato as codcontrato,contratos.fecha_inicio as fechaInicio,contratos.fecha_terminacion as fechaTerminacion,contratos.fechaProrroga as fechaProrroga,ordenadorgasto.nombreOrdenadorG as nombreOrdenador,ordenadorgasto.cargoOrdenadorG as cargoOrdenador,regional.nombre_regional as nombreRegional,centro.nombre_centro as nombreCentro,contratos.veces_RegSireci as vecesRegis,contratos.Obj_contrato as objetoContrato,contratos.Mod_seleccion as modalidad,contratos.Tipo_contrato as tipoContrato,contratos.Cod_secop as codSecop,contratos.valorInit_contrato as valorInicial,contratista.Nit_contratista as NitContratista,contratista.naturaleza_contratista as natuContratista,contratista.tipo_ide as tipoIde,contratista.Nombre_contr as nombreContratista,contratos.tipo_garantia as tipoGarant,contratos.riesgos_asegurados as riesgoAseg,contratos.fecha_expedicion_garantia as fechaExpedicion,contratos.Tipo_seguimiento as tipoSegui,supervisores.docid_supervisor as docidSupervi,supervisores.nombreSupervisor as nombSupervisor,contratos.plazo_contrato as plazoContrato,contratos.pago_anticipado as pagoAnticipa,contratos.adiciones as adicion,contratos.observaciones as observacion,contratos.num_proceso as numProces,contratos.link_secop as link,contratos.lider_proceso as liderProces
          FROM contratos
          INNER JOIN ordenadorgasto ON contratos.ordenador_gasto=ordenadorgasto.docidOrd
          INNER JOIN regional ON contratos.regional=regional.id_regional
          INNER JOIN centro ON regional.centro=centro.centro_id
          INNER JOIN contratista ON contratos.contratista=contratista.Nit_contratista
          INNER JOIN supervisores ON contratos.supervisor=supervisores.docid_supervisor
          where id_contrato=? limit 1");
          $sql->execute([$id]);
          $resultado=$sql->fetch(PDO::FETCH_ASSOC);
          //que no es necesario ponerle eso
    // ciclo que recorra los datos 
          $idContrato=$resultado['idc'];
          $codContrato=$resultado['codcontrato'];
          $fechaInicio=$resultado['fechaInicio'];
          $fechaTermina=$resultado['fechaTerminacion'];
          $fechaProrroga=$resultado['fechaProrroga'];
          $nombreOrdenador=$resultado['nombreOrdenador'];
          $cargoOrdGasto=$resultado['cargoOrdenador'];
          $regional=$resultado['nombreRegional'];
          $centro=$resultado['nombreCentro'];
          $vecesReg=$resultado['vecesRegis'];
          $objContrato=$resultado['objetoContrato'];
          $modSelecc=$resultado['modalidad'];
          $tipContrato=$resultado['tipoContrato'];
          $codSecop=$resultado['codSecop'];
          $valorIni=$resultado['valorInicial'];
          $nitContratista=$resultado['NitContratista'];
          $naturaContratista=$resultado['natuContratista'];
          $tipoIdContratista=$resultado['tipoIde'];
          $NombreContratista=$resultado['nombreContratista'];
          $garantia=$resultado['tipoGarant'];
          $riesgoAsegurado=$resultado['riesgoAseg'];
          $fechaExpedicion=$resultado['fechaExpedicion'];
          $tipSeguimient=$resultado['tipoSegui'];
          $docidSuper=$resultado['docidSupervi'];
          $supervisor=$resultado['nombSupervisor'];
          $plazoContra=$resultado['plazoContrato'];
          $pagoAnticipado=$resultado['pagoAnticipa'];
          $adiciones=$resultado['adicion'];
          $observaciones=$resultado['observacion'];
          $numProces=$resultado['numProces'];
          $linkSecop=$resultado['link'];
          $liderProceso=$resultado['liderProces'];
          
        }
        
      }else{
        echo'error al hacer la peticion';
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../estilos/estilosResBus.css">
    <link rel="stylesheet" href="../../estilos/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Detalles Contratos</title>
</head>
<body>
<header>
        <a href="#" class="logo">
            <img src="../../img/logosena.png" alt="logo del SENA">
            <h2 class="nombreempresa" style="color: black;">SENA</h2>
        </a>
        <nav>
            <a href="../index.php" class="nav-link">Inicio</a>
            <a href="buscadorContratos.php" class="nav-link">Contratos</a>
        </nav>
    </header>  
<script>
        swal("RECUERDA", "El uso inapropiado de esta informacion es ilegal y tiene sanciones");
</script>
    
    <div class="contenedor">
        <div class="cont-info">
            <div class="cont-resultados">
              <div class="tituloC" style="">
                <h3>Informacion Contrato <?php echo $codContrato?></h3>
              </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          Codigo del contrato
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $codContrato?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Fecha de inicio y terminacion del contrato
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <p><?php echo 'Fecha de inicio: '.$fechaInicio.' - Fecha de terminación: '.$fechaTermina?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                            Ordenador del gasto
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <p><?php echo $nombreOrdenador.' - '.$cargoOrdGasto ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                            Regional o centro
                        </button>
                      </h2>
                      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo 'Sena Regional '.$regional.' - '.$centro?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
                            Cantidad de veces que se registró en el Sireci
                        </button>
                      </h2>
                      <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $vecesReg?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseTwo">
                            Objeto del contrato
                        </button>
                      </h2>
                      <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $objContrato?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseTwo">
                            Modalidad de selección
                        </button>
                      </h2>
                      <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $modSelecc?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseTwo">
                            Clase de contrato
                        </button>
                      </h2>
                      <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $tipContrato ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseTwo">
                            Codigo Secop
                        </button>
                      </h2>
                      <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $codSecop ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTwo">
                            Valor Inicial
                        </button>
                      </h2>
                      <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $valorIni?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseTwo">
                            Contratista
                        </button>
                      </h2>
                      <div id="collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <p><?php echo $naturaContratista. ' de nombre '.$NombreContratista.' y con identificación '.$tipoIdContratista.' '.$nitContratista?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwo">
                            Garantías
                        </button>
                      </h2>
                      <div id="collapseTwelve" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <p><b>Tipo de garantía:</b> <?php echo $garantia?></p>
                          <p><b>Riesgo asegurado:</b> <?php echo $riesgoAsegurado?></p>
                          <p><b>Fecha de expedicion de la garantía:</b> <?php echo $fechaExpedicion?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseTwo">
                            Tipo de seguimiento
                        </button>
                      </h2>
                      <div id="collapseThirteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo ''.$tipSeguimient?></p>
                        </div>
                      </div>
                    </div>                    
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseTwo">
                            Datos del supervisor
                        </button>
                      </h2>
                      <div id="collapseFifteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><b>Nombre: </b> <?php echo $supervisor?></p>
                            <p><b>Documento de indentidad: </b><?php echo $docidSuper?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseTwo">
                            Plazo del contrato
                        </button>
                      </h2>
                      <div id="collapseSixteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $plazoContra.' días'?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseTwo">
                            Pago Anticipado
                        </button>
                      </h2>
                      <div id="collapseSeventeen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $pagoAnticipado ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseTwo">
                            Adiciones
                        </button>
                      </h2>
                      <div id="collapseEighteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $adiciones ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNineteen" aria-expanded="false" aria-controls="collapseTwo">
                            Observaciones
                        </button>
                      </h2>
                      <div id="collapseNineteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $observaciones?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwenty" aria-expanded="false" aria-controls="collapseTwo">
                            Numero de proceso
                        </button>
                      </h2>
                      <div id="collapseTwenty" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $numProces ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwenty-one" aria-expanded="false" aria-controls="collapseTwo">
                            Link del contrato en Secop
                        </button>
                      </h2>
                      <div id="collapseTwenty-one" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <a href="<?php echo $linkSecop?>"><?php echo $linkSecop?></a>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwenty-two" aria-expanded="false" aria-controls="collapseTwo">
                            Lider del proceso
                        </button>
                      </h2>
                      <div id="collapseTwenty-two" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $liderProceso?></p>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwenty-three" aria-expanded="false" aria-controls="collapseTwo">
                            Fecha Terminacion de Prorroga
                        </button>
                      </h2>
                      <div id="collapseTwenty-three" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo $fechaProrroga?></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>