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


$consulta = $con->query("select * from usuarios where nombre like lower ('%" . $_POST["buscar"] . "%') order by nombre asc limit 3");
?>
<div class="row p-0 mt-2">
    <?php while ($resultado = $consulta->fetch_assoc()) {
        $datos = $resultado['cod_user'] . "||" .
            $resultado['nombre'] . "||" .
            $resultado['apellido'] . "||" .
            $resultado['celular'] . "||" .
            $resultado['users'] . "||" .
            $resultado['passwords'] . "||" .
            $resultado['nivel'] . "||" .
            $resultado['f_nacimiento'];
    ?>


        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-2">
            <div class="container azul-oscuro text-center redondear pt-2">
                <span class="titulo">Codigo: </span><span><?php echo $resultado['cod_user'] ?></span><br>
                <span class="titulo">Datos: </span><span><?php echo $resultado['nombre'], " ", $resultado['apellido'] ?></span><br>
                <span class="titulo">Cel: </span><span><?php echo $resultado['celular'] ?></span><br>
                <span class="titulo">Usuario: </span><span><?php echo $resultado['users'] ?></span><br>
                <span class="titulo">Puesto: </span><span><?php echo $resultado['nivel'] ?></span><br>
                <span class="titulo">Nacimiento: </span><span><?php echo $resultado['f_nacimiento'] ?></span><br>
                <div class="row mt-2">
                    <div class="d-grid w-50 mb-2">
                        <button type="button" class="btn btn-azul-gris" onclick="llenarmodal_actualizar('<?php echo $datos ?>');" data-bs-toggle="modal" data-bs-target="#actualizarusuario">
                            <i class='bx bxs-edit-alt'></i>
                        </button>
                    </div>
                    <div class="d-grid w-50 mb-2">
                        <button type="button" onclick="eliminacion('<?php echo $resultado['cod_user'] ?>');" class="btn btn-azul-oscuro" id="btnborrausuario"><i class='bx bxs-trash'></i></button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>