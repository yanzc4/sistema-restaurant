<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$codempleado=$_POST['codempleado'];
$fecha=$_POST['currentDateTime'];
$cliente=$_POST['cliente'];


try {
    $consulta="call _crearventas ('$codempleado','$fecha','$cliente')";
    $resultado = mysqli_query($con, $consulta);
    $logo="assets/gif/aceptar.gif";
    $titulo="Listo!";
    $mensaje="¡Venta agregada con exito!";
} catch (\Throwable $th) {
    $logo="assets/gif/error-img.gif";
    $titulo="Error!";
    $mensaje="¡Llenar todos los campos requeridos!";
}
?>

<div class="text-center">
        <img class="w-50" src="<?php echo $logo ?>" alt="">
</div>
<div>
    <h3 class="text-center"><?php echo $titulo ?></h3>
</div>
<div class="text-center">
    <label><?php echo $mensaje ?></label>
</div>
<div class="container text-center mt-4 mb-2">
    <button id="btnaceptonoti" data-bs-dismiss="modal" class="btn bg-azul ms-auto w-25">Ok</button>
</div>