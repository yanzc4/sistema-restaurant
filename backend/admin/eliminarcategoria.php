<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();
$id = $_POST['idc'];

try {
    $consulta = "call _eliminarcategoria ('$id')";
    $resultado = mysqli_query($con, $consulta);
    $logo = "../assets/gif/aceptar.gif";
    $titulo = "Listo!";
    $mensaje = "¡Categoria eliminada con exito!";
} catch (\Throwable $th) {
    $logo = "../assets/gif/error-img.gif";
    $titulo = "Error!";
    $mensaje = "¡No se puede eliminar, porque la categoria contiene patos!";
}
?>

<div class="text-center">
    <img class="w-50" src="<?php echo $logo ?>" alt="">
</div>
<div>
    <h3 class="text-center"><?php echo $titulo ?></h3>
</div>
<div class="text-center">
    <p><?php echo $mensaje ?></p>
</div>
<div class="container text-center mt-4 mb-2">
    <button id="btnaceptonoti" data-bs-dismiss="modal" class="btn bg-azul ms-auto w-25">Ok</button>
</div>