<?php
require_once '../../confi/conexion.php';
require '../../confi/database.php';
require '../../confi/token.php';
$db = new database();
$con = $db->conectar();



$buscador = mysqli_query($link, "SELECT contratos.id_contrato, contratos.fecha_inicio as fechaInicio,contratos.fecha_terminacion as fechaTerminacion, regional.nombre_regional as regional,
contratos.obj_contrato as Objeto, contratista.Nombre_contr as nombreContratista,
supervisores.nombreSupervisor as supervisor 
FROM contratos
INNER JOIN regional ON contratos.regional=regional.id_regional
INNER JOIN contratista ON contratos.contratista=contratista.Nit_contratista
INNER JOIN supervisores ON contratos.supervisor=supervisores.docid_supervisor
WHERE cod_contrato LIKE LOWER('%" . $_POST["buscar"] . "%') OR Obj_contrato LIKE LOWER('%" . $_POST["buscar"] . "%') OR Nombre_contr LIKE LOWER('%" . $_POST["buscar"] . "%') OR link_secop LIKE LOWER('%" . $_POST["buscar"] . "%')");
$numero = mysqli_num_rows($buscador);

?>
<table class="table_id table table-striped table-hover">
    <h5 class="card-tittle">Resultados encontrados (
        <?php echo $numero ?>):
    </h5>
    <thead>
        <tr>
            <th>Fecha Inicio</th>
            <th>Fecha Terminacion</th>
            <th>Regional</th>
            <th>Objeto</th>
            <th>Nombre Contratista</th>
            <th>supervisor</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result = mysqli_fetch_assoc($buscador)) { ?>
            <tr class="resultie">
                <td>
                    <?php echo $row['fechaInicio'] ?>
                </td>
                <td>
                    <?php echo $row['fechaTerminacion'] ?>
                </td>
                <td>
                    <?php echo $row['regional'] ?>
                </td>
                <td>
                    <?php echo $row['Objeto'] ?>
                </td>
                <td>
                    <?php echo $row['nombreContratista'] ?>
                </td>
                <td>
                    <?php echo $row['supervisor'] ?>
                </td>
                <td> <a
                        href="resultadoBus.php?id=<?php echo $row['id_contrato']; ?>&token=<?php echo hash_hmac('sha1', $row['id_contrato'], KEY_TOKEN); ?>"><button
                            class="btn btn-success">Detalles</button></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>