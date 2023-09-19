<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$idve =$_POST["idve"];
$consulta = $con->query("call _listardetalleventa ($idve)");
?>
<div class="container azul-oscuro redondear p-0 text-center mt-3" id="boleta">
    <table class="table">
        <thead>
            <tr class="text-gris-bajo">
                <th class="cod">Cod</th>
                <th>Menu</th>
                <th>Can</th>
                <th>Precio</th>
                <th>dsc</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($resultado = $consulta->fetch_assoc()) { ?>

                <tr class="text-gris-bajo">
                    <td class="cod"><?php echo $resultado['Cod'] ?></td>
                    <td><?php echo $resultado['Menu'] ?></td>
                    <td><?php echo $resultado['Cantidad'] ?></td>
                    <td><?php echo $resultado['Precio'] ?></td>
                    <td><?php echo $resultado['dsc'] ?></td>
                    <td>
                        <button class="btn btn-azul-oscuro" onclick="eliminacion(<?php echo $idve?>,<?php echo $resultado['Cod'] ?>)"><ion-icon name="trash"></ion-icon></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>