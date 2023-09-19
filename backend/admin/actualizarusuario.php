<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include("../db.php");
$con = conectar();

$id=$_POST['id'];
$nom=$_POST['name'];
$ape=$_POST['apellido'];
$cel=$_POST['celular'];
$user=$_POST['usuario'];
$pass=$_POST['pass'];
$nivel=$_POST['nivel'];
$nacimiento=$_POST['nacimiento'];

$consulta = $con->query("call _modificarusuario ('$id','$nom','$ape','$cel','$user','$pass','$nivel','$nacimiento')");
?>
