<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$idcategoria=$_POST['aidcate'];
$nombre=$_POST['acate'];

$consulta = "call _modificarcategoria ($idcategoria,'$nombre')";
echo $resultado=mysqli_query($con,$consulta);
?>