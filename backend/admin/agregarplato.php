<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$plato=$_POST['platonom'];
$categoria=$_POST['platocategoria'];
$precio=$_POST['precioplato'];

$consulta = "call _agregarplato ('$plato',$categoria,$precio)";
echo $resultado=mysqli_query($con,$consulta);

?>