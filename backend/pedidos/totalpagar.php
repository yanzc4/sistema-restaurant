<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$idve = $_POST["idve"];
$consulta = $con->query("call _totalventa ($idve)");
?>

<?php
if ($resultado = $consulta->fetch_assoc()) {
    $dscu = $resultado['dsc'];
    $fecha = $resultado['fecha'];
    $total = $resultado['total'];
} else {
    $dscu = '0.00';
    $fecha = '------';
    $total = '0.00';
}

?>
<div class="container">
    <div class="d-flex">
        <div class="pt-2">
            <h3 class="fw-bold text-azul-medio">Detalle de pago</h3>
        </div>
        <div class="pt-2 ms-auto">
            <a class="btn btn-celeste-bajo" href="backend/reports/ticket.php?idve=<?php echo $idve ?>"><ion-icon name="print"></ion-icon></a>
        </div>
    </div>

    <div class="container azul-oscuro redondear mt-2 py-2">
        <div class="row">
            <div class="col-4">
                <label class="form-label">Descuento total</label><br>
                <label class="form-label">S/. <?php echo $dscu ?></label>
            </div>
            <div class="col-4">
                <label class="form-label">Fecha de venta</label><br>
                <label class="form-label"><?php echo $fecha ?></label>
            </div>
            <div class="col-4">
                <label class="form-label">Total a pagar</label><br>
                <label class="form-label">S/. <?php echo $total ?></label>
            </div>
        </div>
    </div>
</div>