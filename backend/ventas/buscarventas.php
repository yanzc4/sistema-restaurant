<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

session_start();
$cod = $_SESSION['id'];
date_default_timezone_set("America/Lima");
$fecha =getdate();
$fechad= $fecha['year']."-".$fecha['mon']."-".$fecha['mday'];

$usuario = $_SESSION['username'];
if (!isset($usuario)) {
    header("location: index.php");
}

$consulta = $con->query("select id_ventas, cliente, cod_user, fecha from ventas where cod_user='$cod' and fecha ='$fechad' and cliente like lower ('%" . $_POST["buscar"] . "%') order by id_ventas desc limit 4");
?>

<div class="container p-1 pt-2 pb-2 text-center mt-2">
    <table class="table">
        <thead>
            <tr class="text-gris-bajo">
                <th>Cod</th>
                <th>Cliente</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($resultado = $consulta->fetch_assoc()) { 
                $datos=$resultado['id_ventas']."||".
                $resultado['cod_user']."||".
                $resultado['fecha']."||".
                $resultado['cliente'];
                ?>

                <tr class="text-gris-bajo">
                    <td><?php echo $resultado['id_ventas'] ?></td>
                    <td><?php echo $resultado['cliente'] ?></td>
                    <td>
                    <button type="button" class="btn btn-azul-gris" onclick="llenarmodal_actualizar('<?php echo $datos ?>');" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <ion-icon name="pencil-sharp"></ion-icon>
                    </button>
                        <button onclick="eliminacion(<?php echo $resultado['id_ventas'] ?>)" type="button" class="btn btn-azul-oscuro" id="btnborrar"><ion-icon name="trash-sharp"></ion-icon></button>
                        <a class="btn btn-azul-fuerte" href="pedidos.php?idve=<?php echo $resultado['id_ventas']?>" target="myFrame"><ion-icon name="navigate-sharp"></ion-icon></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
