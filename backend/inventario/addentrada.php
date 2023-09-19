<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$produc=$_POST['entradaproducto'];
$fecha=$_POST['entradafecha'];
$cantidad=$_POST['entradacantidad'];
$precio=$_POST['entradaprecio'];
$usuario=$_POST['entradausuario'];


try {
    $consulta="call _addentrada ($produc,'$fecha',$cantidad,$precio,'$usuario')";
    $resultado = mysqli_query($con, $consulta);
    $logo="../assets/gif/aceptar.gif";
    $titulo="Listo!";
    $mensaje="¡Stock actualizado con exito!";
} catch (\Throwable $th) {
    $logo="../assets/gif/error-img.gif";
    $titulo="Error!";
    $mensaje="¡Revise los datos, no se puede ingresar!";
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