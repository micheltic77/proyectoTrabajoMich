<?php
session_start();
$sesion = $_SESSION["docid"];
if (!isset($sesion)) {
    header("location: ../../login/login.php");
    exit;
}

require_once '../../confi/conexion.php';
require '../../confi/database.php';
require '../../confi/token.php';
$db = new database();
$con = $db->conectar();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca</title>
    <link rel="stylesheet" href="../../estilos/estilosBusc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>

<body class="hiden">
    <header>
        <a class="logo">
            <img src="../../img/logosena.png" alt="logo del SENA">
            <h2 class="nombreempresa" style="color:black">SENA</h2>
        </a>
        <nav>
            <a href="../../administrador/index.php" class="nav-link">Inicio</a>
        </nav>
    </header>
    <div class="container mt-5">
        <div class="col-12">

            <div class="mb-3">
                <label class="form-label">Buscar</label>
                <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar con codigo contrato, objeto, nombre del contratista o link del secop">
            </div>
            <button onclick="buscar_ahora($('#buscar').val());" class="btn btn-primary">Buscar</button>

            <div class="card col-12 mt-5">
                <div class="card-body">
                    <div id="datos_buscador" class="container pl-5 pr-5"></div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <table class="table_id table table-striped table-hover">
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
            <?php
            $sql = "SELECT contratos.id_contrato, contratos.fecha_inicio as fechaInicio,contratos.fecha_terminacion as fechaTerminacion, regional.nombre_regional as regional,
                        contratos.obj_contrato as Objeto, contratista.Nombre_contr as nombreContratista,
                        supervisores.nombreSupervisor as supervisor 
                FROM contratos
                INNER JOIN regional ON contratos.regional=regional.id_regional
                INNER JOIN contratista ON contratos.contratista=contratista.Nit_contratista
                INNER JOIN supervisores ON contratos.supervisor=supervisores.docid_supervisor";
            $result = mysqli_query($link, $sql);
            while ($row = $result->fetch_assoc()) {
                ?>
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
                                class="btn btn-success">Detalles</button></a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <script type="text/javascript">
        function buscar_ahora(buscar){
            var parametros = {"buscar":buscar};
            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'buscador.php',
                success:function(data){
                    document.getElementById("datos_buscador").innerHTML = data;
                }
            });
        }
    </script>
</body>

</html>