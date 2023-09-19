<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$titulo=$_POST['titulo'];


$foto=$_FILES['image']['name'];
$ruta=$_FILES['image']['tmp_name'];
$destino="img/".$foto;
copy($ruta,$destino);


$cuerpo=$_POST['cuerpo'];

$query=$con->query("call _agregarnoticia ('$titulo','$destino','$cuerpo')");


if ($query) {
    echo "exito";
} else {
    echo "error";
}
?>