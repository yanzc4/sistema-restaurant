<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$consulta = $con->query("call _wlistarplatos ('%" . $_POST["buscar"] . "%')");
?>

<div class="container p-1 pt-2 text-center mt-2">
    <table class="table">
        <thead>
            <tr class="text-gris-bajo">
                <th>Cod</th>
                <th>Menu</th>
                <th>Precio</th>
                <th>Opcion</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($resultado = $consulta->fetch_assoc()) {
                $datos=$resultado['CODIGO']."||".
                $resultado['PRECIO'];
                ?>

                <tr class="text-gris-bajo">
                    <td><?php echo $resultado['CODIGO'] ?></td>
                    <td><?php echo $resultado['MENU'] ?></td>
                    <td><?php echo $resultado['PRECIO'] ?></td>
                    <td>
                        <button onclick="llenarcajas('<?php echo $datos ?>');" class="btn btn-azul-gris"><ion-icon name="add-outline"></ion-icon></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>