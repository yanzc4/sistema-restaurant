<?php
session_start();
$usuario = $_SESSION['username'];
$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$rol = $_SESSION['rol'];
$cel = $_SESSION['cel'];
$pass = $_SESSION['pass'];
$nacimiento = $_SESSION['fecha'];
if (!isset($usuario)) {
    header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apock web design</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/css/perfilf.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .modal {
            text-align: center;
            background-color: #18191a;
            width: 100%;
        }
    </style>
</head>

<body>
    <!--==========================
=            html            =
===========================-->
    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <div class="perfil-usuario-avatar">
                    <img src="../assets/img/boomerang-logo.png" alt="img-avatar">
                    <button type="button" class="boton-avatar">
                        <i class="far fa-image"></i>
                    </button>
                </div>
                <button type="button" class="boton-portada">
                    <i class="far fa-image"></i> Cambiar fondo
                </button>
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo"><?php echo $nombre, " ", $apellido ?></h3>
                <p class="texto">Trabajador activo del restaurante boomerang, desarrollando el cargo de <?php echo $rol ?>,
                    su codigo de empleado el cual le asigno el sistema es <?php echo $id ?>
                </p>
            </div>
            <div class="perfil-usuario-footer">
                <ul class="lista-datos">
                    <li><i class="icono fas fa-map-signs"></i><label>Direccion de usuario:</label></li>
                    <li><i class="icono fas fa-phone-alt"></i><label>Telefono: <?php echo $cel ?></label></li>
                    <li><i class="icono fas fa-briefcase"></i><label>Trabaja en: Boomerang</label></li>
                    <li><i class="icono fas fa-building"></i><label> Cargo: <?php echo $rol ?></label></li>
                </ul>
                <ul class="lista-datos">
                    <li><i class="icono fas fa-location"></i><label>Ubicacion.</label></li>
                    <li><i class="icono fas fa-calendar-alt"></i><label>Fecha nacimiento.</label></li>
                    <li><i class="icono fas fa-user-alt"></i><label>Registro.</label></li>
                    <li>
                        <i class="icono fas fa-unlock-alt"></i><label>Contraseña</label>
                        <a href="#login-form" class="btn-modal" rel="modal:open"><i class="fas fa-edit" style="color:#317FFF;"></i></a>
                    </li>
                </ul>
            </div>
            <div class="redes-sociales">
                <a href="" class="boton-redes facebook fab fa-facebook-f"><i class="icon-facebook"></i></a>
                <a href="" class="boton-redes twitter fab fa-twitter"><i class="icon-twitter"></i></a>
                <a href="" class="boton-redes instagram fab fa-instagram"><i class="icon-instagram"></i></a>
            </div>
        </div>
    </section>
    <!--====  End of html  ====-->


    <!--====  Modal  ====-->
    <form id="login-form" class="modal">
        <div class="contenedor-modal">
            <input type="text">
            <input type="text">
        </div>
    </form>

    <script src="../assets/js/funcionesprincipales.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
</body>

</html>