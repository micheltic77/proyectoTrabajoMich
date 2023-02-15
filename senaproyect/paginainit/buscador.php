<?php
    include '../confi/conexion.php';
$buscador = mysql_query("SELECT * FROM buscador_avanzado WHERE nombre LIKE LOWER('%" . $_POST["buscar"] . "%') OR tema LIKE LOWER ('%" . $_POST["buscar"] . "%')");
$numero = mysql_num_rows($buscador);
?>

<h3 class="title-results">Resultados Encontrados (<?php echo $numero; ?>):</h3>

<?php while ($resultado = mysql_fetch_assoc($buscador)) { ?>
    <p class="card-text"><?php echo $resultado["nombre"]; ?> - <?php echo $resultado["tema"] ?></p>
<?php }?>