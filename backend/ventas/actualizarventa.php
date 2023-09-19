<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$id=$_POST['idv'];
$codempleado=$_POST['code'];
$fecha=$_POST['fecha'];
$cliente=$_POST['ncliente'];

$consulta = $con->query("call _modificarventa ($id,'$codempleado','$fecha','$cliente')");
?>

