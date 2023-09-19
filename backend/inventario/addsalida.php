<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$produc = $_POST['salidaproducto'];
$fecha = $_POST['salidafecha'];
$cantidad = $_POST['salidacantidad'];
$usuario = $_POST['salidausuario'];

try {
    $consulta="call _addsalida ($produc,'$fecha',$cantidad,'$usuario')";
    $resultado = mysqli_query($con, $consulta);
    $logo="../assets/gif/aceptar.gif";
    $titulo="Listo!";
    $mensaje="¡Salida con exito!";
} catch (\Throwable $th) {
    $logo="../assets/gif/error-img.gif";
    $titulo="Error!";
    $mensaje="¡Stock insuficiente compre mas productos!";
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