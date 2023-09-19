<?php
session_start();
$usuario = $_SESSION['username'];
$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$rol = $_SESSION['rol'];
if (!isset($usuario)) {
    header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/menuestilo.css">
</head>
<body>
<?php require_once('frontend/menuempleado.php') ?>
<section class="home">
    <iframe src="view/dashboardempleado.php" name='myFrame' style="height: 100%; width: 100%; border: none;"></iframe>
    
        <!--<div class="text">Dashboard Sidebar</div>-->
    </section>

    <script src="assets/js/menu/funcionmenu.js"></script>
</body>
</html>