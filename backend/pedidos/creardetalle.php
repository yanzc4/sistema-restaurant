<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$vid=$_POST['idve'];
$pid=$_POST['cplato'];
$pcant=$_POST['pcantidad'];
$pprecio=$_POST['cprecio'];
$pdsc=$_POST['pdsc'];

$consulta = $con->query("call _creardetalleventa ($vid, $pid, $pcant, $pprecio, $pdsc)");
?>