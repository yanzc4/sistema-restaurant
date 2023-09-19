<?php
require 'db.php';
session_start();
$user=$_POST['usuario'];
$pass=$_POST['password'];
$con = conectar();

$consulta = $con->query("select * from usuarios where users='$user' and passwords='$pass'");
$array=$consulta->fetch_assoc();
if ($array>0) {
    $_SESSION['id']=$array["cod_user"];
    $_SESSION['nombre']=$array["nombre"];
    $_SESSION['apellido']=$array["apellido"];
    $_SESSION['rol']=$array["nivel"];
    $_SESSION['cel']=$array["celular"];
    $_SESSION['fecha']=$array["f_nacimiento"];
    $_SESSION['pass']=$pass;
    $_SESSION['username']=$user;
    if ($array["nivel"]=="Administrador") {
        header("location: ../administrador.php");
    }else{
        header("location: ../empleado.php");
    }
    
}else{
    
    echo "datos incorrectos";
}
?>