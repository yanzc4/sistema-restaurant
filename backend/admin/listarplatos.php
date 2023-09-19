<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$consulta = $con->query("call _listarplatos ('%" . $_POST["buscarplato"] . "%')");
?>

<div class="row p-0 mt-2">
    <?php while ($resultado = $consulta->fetch_assoc()) {
        $datos = $resultado['cod'] . "||" .
            $resultado['plato'] . "||" .
            $resultado['idcate'] . "||" .
            $resultado['precio'];
    ?>

        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3 mt-2">
            <div class="container text-center azul-oscuro redondear pt-2">
                <span class="titulo">Codigo: </span><span><?php echo $resultado['cod'] ?></span><br>
                <span class="titulo">Plato: </span><span><?php echo $resultado['plato'] ?></span><br>
                <span class="titulo">Categoría: </span><span><?php echo $resultado['categoria'] ?></span><br>
                <span class="titulo">Precio: </span><span><?php echo $resultado['precio'] ?></span><br>
                <div class="row mt-2">
                    <div class="d-grid w-50 mb-2">
                        <button type="button" class="btn btn-azul-gris" onclick="llenarcomboedit();llenarmodal_plato('<?php echo $datos ?>');" data-bs-toggle="modal" data-bs-target="#actualizarplato">
                            <i class='bx bxs-edit-alt'></i>
                        </button>
                    </div>
                    <div class="d-grid w-50 mb-2">
                        <button type="button" onclick="eliminarplato('<?php echo $resultado['cod'] ?>');" class="btn btn-azul-oscuro" id="btnborraplato"><i class='bx bxs-trash'></i></button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>