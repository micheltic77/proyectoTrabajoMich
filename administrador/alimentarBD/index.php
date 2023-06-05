<?php
    session_start();
    
    if(!isset($_SESSION["docid"]) ){
        header("location: ../login/login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alimentar BD</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="../../estilos/estilos.css">
  <link rel="stylesheet" type="text/css" href="css/cssGenerales.css">
</head>

<body>

<header>
        <a href="#" class="logo">
            <img src="../../img/logosena.png" alt="logo del SENA">
            <h2 class="nombreempresa">SENA</h2>
        </a>
        <nav>
            <a href="../index.php" class="nav-link">Inicio</a>
            <a href="../buscador/buscadorContratos.php" class="nav-link">Contratos</a>
        </nav>
    </header>
  <div class="cargando">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
  </div>

  <div class="container">

    <h3 class="text-center">
      Importar a la base de datos
    </h3>
    <hr>
    <br><br>
    <div class="row">
      <div class="col-md-7">
        <form action="recibe_excel_validando.php" method="POST" enctype="multipart/form-data">
          <div class="file-input text-center">
            <input type="file" name="contratos" id="file-input" class="file-input__input" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            <label class="file-input__label" for="file-input">
              <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
              <span>Elegir Archivo Excel</span>
            </label>
          </div>
          <div class="text-center mt-5">
            <input type="submit" name="subir" class="btn-enviar" value="Subir Excel" />
          </div>
        </form>
      </div>

      <div class="col-md-5">
        <?php
        header("Content-Type: text/html;charset=utf-8");
        include('../../confi/conexion.php');
        $sqlContratos = "SELECT contratos.id_contrato, regional.nombre_regional as regional,
        contratos.obj_contrato as Objeto, contratista.Nombre_contr as nombreContratista,
        supervisores.nombreSupervisor as supervisor 
        FROM contratos
        INNER JOIN regional ON contratos.regional=regional.id_regional
        INNER JOIN contratista ON contratos.contratista=contratista.Nit_contratista
        INNER JOIN supervisores ON contratos.supervisor=supervisores.docid_supervisor";
        $result = mysqli_query($link, $sqlContratos);
        while ($row = $result->fetch_assoc()) {
          ?>


          <table class="table table-bordered table-striped">
            <tr class="resultie">
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
            </tr>
          <?php
        }
        ?>

      </div>
    </div>

  </div>


  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function () {
      $(window).load(function () {
        $(".cargando").fadeOut(1000);
      });
    });
  </script>

</body>

</html>