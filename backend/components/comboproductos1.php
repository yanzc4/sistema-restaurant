<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$consulta = $con->query("select * from productos");
?>

<select name="salidaproducto" class="form-control">
    <?php
    while ($row = mysqli_fetch_array($consulta)) {
        $id = $row['id_producto'];
        $nombres = $row['nombre'];
    ?>
        <option value="<?php echo $id ?>"><?php echo $nombres ?></option>
    <?php
    }
    ?>
</select>