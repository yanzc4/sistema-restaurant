<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$cod=$_POST['aidplato'];
$plato=$_POST['aplatonom'];
$categoria=$_POST['aplatocategoria'];
$precio=$_POST['aprecioplato'];

$consulta = "call _modificarplato ($cod,'$plato',$categoria,$precio)";
echo $resultado=mysqli_query($con,$consulta);

?>