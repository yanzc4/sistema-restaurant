<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$nombre=$_POST['icate'];

$consulta = "call _agregarcategoria ('$nombre')";
echo $resultado=mysqli_query($con,$consulta);
?>