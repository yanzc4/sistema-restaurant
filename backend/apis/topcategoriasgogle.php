<?php
// Valores con PHP. Estos podrían venir de una base de datos o de cualquier lugar del servidor

include("../db.php");
$con = conectar();
$rpta= array();
$consulta = $con->query("call _topcategorias");
while ($resultado = $consulta->fetch_assoc()) {
    array_push($rpta, $resultado['nombre']);
    array_push($rpta, $resultado['sum(vd.cantidad)']);
    //array_push($rpta, "['" . $resultado['nombre']."', " .$resultado['sum(vd.cantidad)']."],");
}

echo json_encode($rpta);