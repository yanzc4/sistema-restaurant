<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();


$consulta = $con->query("select * from noticias");
?>

<?php
while ($resultado = $consulta->fetch_assoc()) { ?>
    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3">
        <div class="container bg-gris redondear pt-3 pb-1">
            <div>
                <label>Admin-<?php echo $resultado['fecha'] ?></label>
            </div>
            <div>
                <label class="mt-2 fw-bold"><?php echo $resultado['titulo'] ?></label>
            </div>
            <div class="container bg-lila redondear text-center">
                <img class="foto mt-2 mb-2" src="../backend/productos/<?php echo $resultado['imagen'] ?>">
            </div>
            <p class="mt-2 text-center">
                <?php echo $resultado['cuerpo'] ?>
            </p>
        </div>
    </div>

<?php } ?>