<?php
// Valores con PHP. Estos podrían venir de una base de datos o de cualquier lugar del servidor

include("../db.php");
$con = conectar();
$respuesta["etiquetas"]=array();
$respuesta["datos"]=array();
$consulta = $con->query("call _topcategorias");
while ($resultado = $consulta->fetch_assoc()) {
    array_push($respuesta['etiquetas'], $resultado['nombre']);
    array_push($respuesta['datos'], $resultado['sum(vd.cantidad)']);
}

echo json_encode($respuesta);