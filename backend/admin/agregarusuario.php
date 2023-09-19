<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$cod=$_POST['codigo'];
$nombre=$_POST['nombre'];
$apellido=$_POST['aapellido'];
$celular=$_POST['acelular'];
$user=$_POST['user'];
$pass=$_POST['apass'];
$rol=$_POST['rol'];
$fecha=$_POST['fecha'];

$consulta = "call _agregarusuario ('$cod', '$nombre', '$apellido', '$celular', '$user', '$pass', '$rol', '$fecha')";
echo $resultado=mysqli_query($con,$consulta);
?>