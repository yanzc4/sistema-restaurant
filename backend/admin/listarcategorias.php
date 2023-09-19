<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

session_start();
$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
if (!isset($usuario)) {
    header("location: index.php");
}
if ($rol == "Empleado") {
    header("location: index.php");
}


$consulta = $con->query("select * from categoria_p where nombre like lower ('%" . $_POST["buscarcate"] . "%') order by id_categoria desc limit 3");
?>

<div class="container p-0 pb-1 mt-2 text-center azul-oscuro redondear">
    <table class="table">
        <thead>
            <tr class="text-gris-bajo">
                <th>Categoria</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($resultado = $consulta->fetch_assoc()) {
                $datos = $resultado['id_categoria'] . "||" .
                    $resultado['nombre'];
            ?>
                <tr class="text-gris-bajo">
                    <td><?php echo $resultado['nombre'] ?></td>
                    <td>
                        <button type="button" class="btn btn-azul-gris" onclick="llenarmodal_categoria('<?php echo $datos ?>');" data-bs-toggle="modal" data-bs-target="#actualizarcategoria">
                            <i class='bx bxs-edit-alt'></i>
                        </button>
                        <button onclick="eliminarcategoria(<?php echo $resultado['id_categoria'] ?>)" type="button" class="btn btn-azul-oscuro" id="btnborrar"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>