<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();
$id = $_POST['idv'];

    $consulta = $con->query("call _cambiarfondo ($id)");
?>