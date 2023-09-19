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
if ($rol == "Empleado") {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/ajustes.css">
</head>

<body>
    <div class="container">
        <div class="row">

            <section id="usuarios">
                <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9 mt-3 centrando">

                    <div class="d-flex pt-2">
                        <h3 class="me-2 fw-bold text-azul-medio">Inventario</h3>
                        <button id="pruebacrear" class="btn btn-azul-oscuro ms-auto" data-bs-toggle="modal" data-bs-target="#agregarproducto"><i class='bx bx-receipt'></i></button>
                        <button id="pruebaagregar" onclick="llenarcombo();" class="btn btn-azul-gris ms-2" data-bs-toggle="modal" data-bs-target="#addstock"><i class='bx bx-add-to-queue'></i></button>
                        <button id="prueba" onclick="llenarcombo1();" class="btn btn-azul-fuerte ms-2" data-bs-toggle="modal" data-bs-target="#addsalida"><i class='bx bx-layer-minus'></i></button>
                    </div>

                    <div class="d-flex mt-2">
                        <div class="col">
                            <input onkeyup="buscar_ahora($('#buscar').val());" type="text" class="form-control bg-transparent text-azul-medio" id="buscar" name="buscar" placeholder="Buscar usuario">
                        </div>
                        <div class="col-auto ms-2">
                            <button class="btn btn-celeste-bajo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="container azul-oscuro redondear p-0 mt-2" id="datos_buscador"></div>
                </div>
            </section>


        </div>
    </div>

    <button id="prueba1" type="hidden" data-bs-toggle="modal" data-bs-target="#noti2"></button>

    <div class="modal fade" id="noti2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" id="cuerpo-noti2">


            </div>
        </div>
    </div>
</div>


    <?php require_once('../frontend/modalinventario.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../assets/js/inventario/funcionesinventario.js"></script>
</body>

</html>