<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();


$consulta = $con->query("call _infoventas");
?>

<?php
if ($resultado = $consulta->fetch_assoc()) {

    $total = $resultado['total'];
    $ventas = $resultado['ventas'];
    $descuento = $resultado['descuento'];
} else {
    $total = '0.00';
    $ventas = '0';
    $descuento = '0.00';
}

?>
<div class="glider">
    <div class="bg-rojizo text-center redondear">
        <i class="fa-solid fa-sack-dollar icon"></i>
        <label class="titulo"><?php echo $total ?></label><br>
        <label class="subtitulo">Ventas del mes</label>
    </div>
    <div class="container">
        <div class="bg-lila text-center redondear">
            <i class="fa-solid fa-utensils icon"></i>
            <label class="titulo"><?php echo $ventas ?></label><br>
            <label class="subtitulo">Platos vendidos</label>
        </div>
    </div>
    <div class="bg-celeste text-center redondear">
        <i class="fa-solid fa-receipt icon"></i>
        <label class="titulo"><?php echo $descuento ?></label><br>
        <label class="subtitulo">Descuento total</label>
    </div>
</div>

<script>
    new Glider(document.querySelector('.glider'), {
        slidesToShow: 3,
        slidesToScroll: 1,
        draggable: true,
        dots: '.dots',
        arrows: {
            prev: '.glider-prev',
            next: '.glider-next'
        }
    });
</script>