<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

session_start();
$usuario = $_SESSION['username'];
if (!isset($usuario)) {
    header("location: index.php");
}

$consulta = $con->query("call _listaplatospedidos('%" . $_POST["buscar"] . "%')");
?>

<div class="container p-0 text-center mt-2">
    <table class="table">
        <thead>
            <tr class="text-gris-bajo">
                <th>Cliente</th>
                <th>Plato</th>
                <th>U</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($resultado = $consulta->fetch_assoc()) { 
                if ($resultado['color']==1) {
                    $color="azul-medio text-gris-bajo";
                }else{
                    $color="text-gris-bajo";
                }
                ?>

                <tr class="<?php echo $color ?>">
                    <td><?php echo $resultado['cliente'] ?></td>
                    <td><?php echo $resultado['nombre'] ?></td>
                    <td><?php echo $resultado['cantidad'] ?></td>
                    <td>
                    <button type="button" class="btn btn-secondary" onclick="aceptarpedido(<?php echo $resultado['id'] ?>);">
                    <i class='bx bxs-select-multiple'></i>
                    </button>
                        <button onclick="eliminacion(<?php echo $resultado['id'] ?>)" type="button" class="btn btn-secondary" id="btnborrar"><i class='bx bx-check-double'></i></button>
                        
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
