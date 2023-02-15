<?php
    require_once "../confi/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proy</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
    <div class="cont-buscador">
        <div class="divbu">
            <label class="form-label">Buscar Contrato</label>
            <input onkeyup="buscar_ahora($('#buscar').val());" type="text" class="form-control" id="buscar_1" name="buscar_1">
        </div>

        <div class="card">
            <div class="card-body">
                <div id="datos_buscador" class="container"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function buscar_ahora(buscar){
            var parametros ={"buscar":buscar};
            $.ajax({
                data:parametros,
                type: 'POST',
                url:'buscador.php',
                success: function(data){
                    document.getElementById("datos_buscador").innerHTML=data;
                }
            });
        }

    </script>
</body>
</html>