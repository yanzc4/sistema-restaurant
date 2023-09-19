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
    <?php //require_once('../frontend/menuajustes.php') 
    ?>
    <div class="container">
        <div class="row">

            <section id="usuarios">
                <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9 mt-3 centrando">

                    <div class="d-flex pt-2">
                        <h3 class="me-2 fw-bold text-azul-medio">Usuarios</h3>
                        <button class="btn btn-azul-gris ms-auto" data-bs-toggle="modal" data-bs-target="#nuevousuario"><i class='bx bx-user-plus'></i></button>
                    </div>

                    <div class="d-flex mt-2">
                        <div class="col">
                            <input onkeyup="buscar_ahora($('#buscar').val());" type="text" class="form-control bg-transparent text-azul-medio" id="buscar" name="buscar" placeholder="Buscar usuario">
                        </div>
                        <div class="col-auto ms-2">
                            <a class="btn btn-celeste-bajo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="container p-0 mt-2" id="datos_buscador"></div>
                </div>
            </section>

            <section id="categorias">
                <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9 mt-3 centrando">
                    <div class="d-flex pt-2">
                        <h3 class="me-2 fw-bold text-azul-medio">Categorias</h3>
                        <button class="btn btn-azul-gris ms-auto" data-bs-toggle="modal" data-bs-target="#agregarcategoria"><i class='bx bxs-add-to-queue'></i></button>
                    </div>

                    <div class="d-flex mt-2">
                        <div class="col">
                            <input onkeyup="buscar_categoria($('#buscarcate').val());" type="text" class="form-control bg-transparent text-azul-medio" id="buscarcate" name="buscarcate" placeholder="Buscar categoria">
                        </div>
                        <div class="col-auto ms-2">
                            <a class="btn btn-celeste-bajo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="container p-0 mt-2" id="categoria_buscador"></div>
                </div>
            </section>

            <section id="platos">
                <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9 mt-3 centrando">
                    <div class="d-flex pt-2">
                        <h3 class="me-2 fw-bold text-azul-medio">Platos</h3>
                        <button onclick="llenarcombo();" class="btn btn-azul-gris ms-auto" data-bs-toggle="modal" data-bs-target="#agregarplato"><i class='bx bxs-add-to-queue'></i></button>
                    </div>

                    <div class="d-flex mt-2">
                        <div class="col">
                            <input onkeyup="buscar_plato($('#buscarplato').val());" type="text" class="form-control bg-transparent text-azul-medio" id="buscarplato" name="buscarplato" placeholder="Buscar plato">
                        </div>
                        <div class="col-auto ms-2">
                            <a class="btn btn-celeste-bajo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div id="plato_buscador"></div>
                </div>
            </section>

        </div>
    </div>

    <?php require_once('../frontend/modalajustes.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../assets/js/admin/funcionesajustes.js"></script>
</body>

</html>