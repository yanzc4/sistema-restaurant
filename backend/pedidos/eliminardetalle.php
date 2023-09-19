<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();
$idv = $_POST['idv'];
$idp = $_POST['idp'];

    $consulta = $con->query("call _eliminardetalleventa ($idv, $idp)");;
?>