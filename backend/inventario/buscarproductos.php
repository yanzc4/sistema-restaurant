<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

session_start();
$cod = $_SESSION['id'];
$usuario = $_SESSION['username'];
if (!isset($usuario)) {
    header("location: index.php");
}

$consulta = $con->query("call _listarinventario ('%" . $_POST["buscar"] . "%')");
?>

<div class="container p-0 text-center mt-2">
    <table class="table">
        <thead>
            <tr class="text-gris-bajo">
                <th class="cod">Cod</th>
                <th>Producto</th>
                <th>Stock</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($resultado = $consulta->fetch_assoc()) { 
                $datos=$resultado['id_producto']."||".
                $resultado['nombre']."||".
                $resultado['stock'];
                ?>

                <tr class="text-gris-bajo">
                    <td class="cod"><?php echo $resultado['id_producto'] ?></td>
                    <td><?php echo $resultado['nombre'] ?></td>
                    <td><?php echo $resultado['stock'] ?></td>
                    <td>
                    <button type="button" class="btn btn-azul-gris" onclick="llenarmodal_actualizar('<?php echo $datos ?>');" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class='bx bx-edit-alt'></i>
                    </button>
                        <button onclick="eliminacion(<?php echo $resultado['id_producto'] ?>)" type="button" class="btn btn-azul-oscuro" id="btnborrar"><i class='bx bx-trash' ></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>