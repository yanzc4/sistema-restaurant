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

date_default_timezone_set("America/Lima");
$hoy =getdate();
$fechah= $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/ajustes.css">
</head>

<body>
    <div class="container my-3" id="tabla_ventas">
        <div class="row">

            <div id="buscador" class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                <div class="container">
                    <h3 class="pt-2 fw-bold text-azul-medio">Ventas</h3>
                    <div class="d-flex mt-2">
                        <div class="col">
                            <input onkeyup="buscar_ahora($('#buscar_1').val());" type="text" class="form-control bg-transparent text-azul-medio" id="buscar_1" name="buscar_1" placeholder="Buscar cliente">
                        </div>
                        <div class="col-auto ms-2">
                            <a class="btn btn-celeste-bajo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="container azul-oscuro redondear p-0 mt-3" id="datos_buscador">

                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                <div class="container">
                    <h3 class="pt-2 fw-bold text-azul-medio">Nueva Venta</h3>
                    <div class="container azul-oscuro redondear">
                        <form id="frmajax" method="POST">
                            <div class="pt-2">
                                <label>Codigo Empleado</label>
                                <input type="text" class="form-control" id="codempleado" name="codempleado" value="<?php echo $id ?>" readonly="readonly">
                            </div>
                            <div>
                                <label>Fecha</label>
                                <input type="text" value="<?php echo $fechah ?>" class="form-control" name="currentDateTime" id="currentDateTime" readonly="readonly">
                            </div>
                            <div>
                                <label>Nombre del cliente</label>
                                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nombre del Cliente">
                            </div>
                            <div class="row mt-3">
                                <div class="d-grid w-50 mb-3">
                                    <button id="btnguardar" class="btn btn-azul-gris">Registrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmactualizar" method="POST">
                            <div>
                                <label>Id</label>
                                <input type="text" class="form-control w-25" id="idv" name="idv" value="" readonly="readonly">
                            </div>
                            <div>
                                <label>Codigo Empleado</label>
                                <input type="text" class="form-control w-25" id="code" name="code" value="" readonly="readonly">
                            </div>
                            <div>
                                <label>Fecha</label>
                                <input type="text" class="form-control w-auto" name="fecha" id="fecha" readonly="readonly">
                            </div>
                            <div>
                                <label>Nombre del cliente</label>
                                <input type="text" class="form-control" id="ncliente" name="ncliente" placeholder="Nombre del Cliente">
                            </div>
                            <div class="row mt-3">
                                <div class="d-grid w-50">
                                    <button id="btnactualizar" class="btn bg-azul">Guardar</button>
                                </div>
                                <!--
                                <div class="d-grid w-50">
                                    <button id="btneliminar" class="btn btn-danger">Eliminar</button>
                                </div>
                                -->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="noti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body" id="cuerpo-noti">


                    </div>
                </div>
            </div>
        </div>


        <script src="assets/js/venta/funcionesventa.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>