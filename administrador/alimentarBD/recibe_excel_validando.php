<?php
include('../../confi/conexion.php');
$tipo = $_FILES['contratos']['type'];
$tamanio = $_FILES['contratos']['size'];
$archivotmp = $_FILES['contratos']['tmp_name'];
$lineas = file($archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados = ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);

        $numContrato = !empty($datos[0]) ? ($datos[0]) : '';
        $fechaSuscripcion = !empty($datos[1]) ? ($datos[1]) : '';
        $nombreOrd = !empty($datos[2]) ? ($datos[2]) : '';
        $documentOrd = !empty($datos[3]) ? ($datos[3]) : '';
        $cargoOrd = !empty($datos[4]) ? ($datos[4]) : '';
        $vecesRegSire = !empty($datos[5]) ? ($datos[5]) : '';
        $objContrato = !empty($datos[6]) ? ($datos[6]) : '';
        $modSeleccion = !empty($datos[7]) ? ($datos[7]) : '';
        $claseContrato = !empty($datos[8]) ? ($datos[8]) : '';
        $codSecop = !empty($datos[9]) ? ($datos[9]) : '';
        $valorInic = !empty($datos[10]) ? ($datos[10]) : '';
        $natContratista = !empty($datos[11]) ? ($datos[11]) : '';
        $tipoIdentificContrat = !empty($datos[12]) ? ($datos[12]) : '';
        $numNitContra = !empty($datos[13]) ? ($datos[13]) : '';
        $nombreContra = !empty($datos[14]) ? ($datos[14]) : '';
        $tipoGarantia = !empty($datos[15]) ? ($datos[15]) : '';
        $garantiaRiesgo = !empty($datos[16]) ? ($datos[16]) : '';
        $fechaExpGarantia = !empty($datos[17]) ? ($datos[17]) : '';
        $tipSeguimiento = !empty($datos[18]) ? ($datos[18]) : '';
        $numIdeSupervisor = !empty($datos[19]) ? ($datos[19]) : '';
        $nombreSupervisor = !empty($datos[20]) ? ($datos[20]) : '';
        $plazoContrato = !empty($datos[21]) ? ($datos[21]) : '';
        $anticipo = !empty($datos[22]) ? ($datos[22]) : '';
        $adiciones = !empty($datos[23]) ? ($datos[23]) : '';
        $vtAdicion = !empty($datos[24]) ? ($datos[24]) : '';
        $diasAdicion = !empty($datos[25]) ? ($datos[25]) : '';
        $fechaInicio = !empty($datos[26]) ? ($datos[26]) : '';
        $fechaTerminacion = !empty($datos[27]) ? ($datos[27]) : '';
        $fechaTermProrroga = !empty($datos[28]) ? ($datos[28]) : '';
        $observaciones = !empty($datos[29]) ? ($datos[29]) : '';
        $regionalId = !empty($datos[30]) ? ($datos[30]) : '';
        $regionalNombre = !empty($datos[31]) ? ($datos[31]) : '';
        $centroId = !empty($datos[32]) ? ($datos[32]) : '';
        $centroNombre = !empty($datos[33]) ? ($datos[33]) : '';
        $numProceso = !empty($datos[34]) ? ($datos[34]) : '';
        $linkSecop = !empty($datos[35]) ? ($datos[35]) : '';
        $liderProceso = !empty($datos[36]) ? ($datos[36]) : '';




        //------------------------------------------------------------------------------------------------------------
        if (!empty($centroId)) {
            $checkcentro_duplicidad = ("SELECT centro_id FROM centro WHERE centro_id='" . ($centroId) . "'");
            $ce_dupli = mysqli_query($link, $checkcentro_duplicidad);
            $cant_centroDu = mysqli_num_rows($ce_dupli);

            //no hay registros duplicados tabla centro
            if ($cant_centroDu == 0) {
                $insertarDataCen = "INSERT INTO centro(centro_id, nombre_centro)VALUES('$centroId', '$centroNombre')";
                mysqli_query($link, $insertarDataCen);
            }
            /**Caso Contrario actualizo el o los Registros ya existentes*/
            else {
                $updateDataCen = ("UPDATE centro SET centro_id='" . $centroId . "', nombre_centro='" . $centroNombre . "' WHERE centro_id='" . $centroId . "'");
                $resultCe_update = mysqli_query($link, $updateDataCen);
            }
        }

        //------------------------------------------------------------------------------------------------------------
        if (!empty($numNitContra)) {
            $checkcontra_duplicidad = ("SELECT Nit_contratista FROM contratista WHERE Nit_contratista='" . ($numNitContra) . "' ");
            $con_dupli = mysqli_query($link, $checkcontra_duplicidad);
            $cant_contraDu = mysqli_num_rows($con_dupli);

            //no hay registros duplicados tabla contratista
            if ($cant_contraDu == 0) {
                $insertarDataCon = "INSERT INTO contratista(Nit_contratista, naturaleza_contratista, tipo_ide, Nombre_contr) 
            VALUES('$numNitContra', '$natContratista', '$tipoIdentificContrat', '$nombreContra')";
                mysqli_query($link, $insertarDataCon);
            }
            /**Caso Contrario actualizo el o los Registros ya existentes*/else {
                $updateDataCon = ("UPDATE contratista SET Nit_contratista='" . $numNitContra . "', naturaleza_contratista='" . $natContratista . "', Nombre_contr='" . $nombreContra . "' WHERE centro_id='" . $numNitContra . "'");
                $result_updateCon = mysqli_query($link, $updateDataCon);
            }
        }

        //------------------------------------------------------------------------------------------------------------
        if (!empty($documentOrd)) {
            $checkord_duplicidad = ("SELECT docidOrd FROM ordenadorgasto WHERE docidOrd='" . ($documentOrd) . "' ");
            $Ord_dupli = mysqli_query($link, $checkord_duplicidad);
            $cant_ordenadorDu = mysqli_num_rows($Ord_dupli);

            //no hay registros duplicados tabla ordenador gasto
            if ($cant_ordenadorDu == 0) {
                $insertarDataOrd = "INSERT INTO ordenadorgasto(docidOrd, nombreOrdenadorG, cargoOrdenadorG)
            VALUES('$documentOrd', '$nombreOrd', '$cargoOrd')";
                mysqli_query($link, $insertarDataOrd);
            }
            /**Caso Contrario actualizo el o los Registros ya existentes*/else {
                $updateDataOrd = ("UPDATE ordenadorgasto SET 
            docidOrd='" . $documentOrd . "', nombreOrdenadorG='" . $nombreOrd . "', cargoOrdenadorG='" . $cargoOrd . "' WHERE docidOrd='" . $documentOrd . "'
        ");
                $result_updateOrd = mysqli_query($link, $updateDataOrd);
            }
        }

        //------------------------------------------------------------------------------------------------------------
        if (!empty($regionalId)) {
            $checkreg_duplicidad = ("SELECT id_regional FROM regional WHERE id_regional='" . ($regionalId) . "' ");
            $reg_dupli = mysqli_query($link, $checkreg_duplicidad);
            $cant_regionalDu = mysqli_num_rows($reg_dupli);

            //no hay registros duplicados tabla regional
            if ($cant_regionalDu == 0) {

                $insertarDataReg = "INSERT INTO regional(id_regional, nombre_regional, centro) VALUES('$regionalId', '$regionalNombre', '$centroId')";
                mysqli_query($link, $insertarDataReg);
            }
            /**Caso Contrario actualizo el o los Registros ya existentes*/else {
                $updateDataReg = ("UPDATE regional SET 
            id_regional='" . $regionalId . "', nombre_regional='" . $regionalNombre . "', centro='" . $centroId . "' WHERE id_regional='" . $regionalId . "'
        ");
                $resultReg_update = mysqli_query($link, $updateDataReg);
            }
        }

        //------------------------------------------------------------------------------------------------------------
        if (!empty($numIdeSupervisor)) {
            
            $checksu_duplicidad = ("SELECT docid_supervisor FROM supervisores WHERE docid_supervisor='" . ($numIdeSupervisor) . "' ");
            $sup_dupli = mysqli_query($link, $checksu_duplicidad);
            $cant_supervisorDu = mysqli_num_rows($sup_dupli);

            //no hay registros duplicados tabla supervisores
            if ($cant_supervisorDu == 0) {
                $insertarDataSup = "INSERT INTO supervisores(docid_supervisor, nombreSupervisor) VALUES('$numIdeSupervisor', '$nombreSupervisor')";
                mysqli_query($link, $insertarDataSup);
            }
            /**Caso Contrario actualizo el o los Registros ya existentes*/else {
                $updateDataSup = ("UPDATE supervisores SET 
            docid_supervisor='" . $numIdeSupervisor . "', nombreSupervisor='" . $nombreSupervisor . "' WHERE docid_supervisor='" . $numIdeSupervisor . "'
        ");
                $resultSup_update = mysqli_query($link, $updateDataSup);
            }

        }

        if (!empty($numContrato)) {
            $check_duplicidad = ("SELECT cod_contrato FROM contratos WHERE cod_contrato='" . ($numContrato) . "' ");
            $ca_dupli = mysqli_query($link, $check_duplicidad);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);

            //No existe Registros Duplicados tabla contratos
            if ($cant_duplicidad == 0) {
                $insertarData = "INSERT INTO contratos (cod_contrato, fechaSuscripcion, fecha_inicio, fecha_terminacion, fechaProrroga, ordenador_gasto, regional, veces_RegSireci, Obj_contrato, Mod_seleccion, Tipo_contrato, Cod_secop, valorInit_contrato, contratista, tipo_garantia, riesgos_asegurados, fecha_expedicion_garantia, Tipo_seguimiento, supervisor, plazo_contrato, pago_anticipado, adiciones, valorAdicion, numDiasAdicion, observaciones, num_proceso, link_secop, lider_proceso) 
                VALUES('$numContrato', '$fechaSuscripcion', '$fechaInicio', '$fechaTerminacion', '$fechaTermProrroga','$documentOrd', '$regionalId', '$vecesRegSire', '$objContrato', '$modSeleccion', '$claseContrato', '$codSecop', '$valorInic', '$numNitContra', '$tipoGarantia', '$garantiaRiesgo', '$fechaExpGarantia', '$tipSeguimiento', '$numIdeSupervisor', '$plazoContrato', '$anticipo', '$adiciones', '$vtAdicion', '$diasAdicion', '$observaciones', '$numProceso', '$linkSecop', '$liderProceso')";
                mysqli_query($link, $insertarData);
            }
            /**Caso Contrario actualizo el o los Registros ya existentes*/else {
                $updateData = ("UPDATE contratos SET cod_contrato='" . $numContrato . "', fechaSuscripcion='" . $fechaSuscripcion . "', fecha_inicio='" . $fechaInicio . "', fecha_terminacion='" . $fechaTerminacion . "', fechaProrroga='" . $fechaTermProrroga . "', ordenador_gasto='" . $documentOrd . "', regional='" . $regionalId . "', veces_RegSireci='" . $vecesRegSire . "', Obj_contrato='" . $objContrato . "', Mod_seleccion='" . $modSeleccion . "', Tipo_contrato='" . $claseContrato . "', Cod_secop='" . $codSecop . "', valorInit_contrato='" . $valorInic . "', contratista='" . $numNitContra . "', tipo_garantia='" . $tipoGarantia . "', riesgos_asegurados='" . $garantiaRiesgo . "', fecha_expedicion_garantia='" . $fechaExpGarantia . "', Tipo_seguimiento='" . $tipSeguimiento . "', supervisor='" . $numIdeSupervisor . "', plazo_contrato='" . $plazoContrato . "', pago_anticipado='" . $anticipo . "', adiciones='" . $adiciones . "', valorAdicion='" . $vtAdicion . "', numDiasAdicion='" . $diasAdicion . "', observaciones='" . $observaciones . "', num_proceso='" . $numProceso . "', link_secop='" . $linkSecop . "', lider_proceso='" . $liderProceso . "' WHERE cod_contrato='" . $numContrato . "'");
                $result_update = mysqli_query($link, $updateData);
            }
        }

        //------------------------------------------------------------------------------------------------------------
    }

    $i++;
}

?>

<a href="index.php">Atras</a>