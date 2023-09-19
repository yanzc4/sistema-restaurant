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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/ajustes.css">
</head>

<body>

    <div class="container my-3">
        <div class="row">

            <div id="buscador" class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                <div class="container">
                    <h3 class="pt-2 fw-bold text-azul-medio">Platos</h3>
                    <div class="d-flex mt-2">
                        <div class="col">
                            <input onkeyup="buscar_ahora($('#buscar_1').val());" type="text" class="form-control bg-transparent text-azul-medio" id="buscar_1" name="buscar_1" placeholder="Buscar Plato">
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
                    <h3 class="pt-2 fw-bold text-azul-medio">Informacion</h3>
                    <div class="container azul-oscuro redondear py-2">
                        <form id="frmdetalle" method="POST">
                            <div class="row">

                                <div class="col-4">
                                    <label class="form-label">Codigo venta</label>
                                    <input type="text" class="form-control" name="idve" id="idve" value="<?php echo $_GET["idve"] ?>" readonly="readonly">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Codigo de Plato</label>
                                    <input type="text" class="form-control" name="cplato" id="cplato" value="" readonly="readonly">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Precio Unitario</label>
                                    <input type="text" class="form-control" name="cprecio" id="cprecio" value="" readonly="readonly">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" value="1" name="pcantidad" id="pcantidad">
                                </div>
                                <div class="col-4 ">
                                    <label class="form-label">Descuento</label>
                                    <input type="number" class="form-control" value="0.00" name="pdsc" id="pdsc">
                                </div>
                                <div class="col-4 mb-3 mt-4">
                                    <button class="btn btn-azul-gris" id="btnnuevodetalle"><ion-icon name="add-outline"></ion-icon></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                <div class="container">
                    <h3 class="pt-2 fw-bold text-azul-medio">Datos del Pedido <?php echo $_GET["idve"] ?></h3>
                    <div id="detalle_tabla"></div>

                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3" id="totalpagar">

            </div>
        </div>

    </div>




    <script src="assets/js/pedidos/funcionespedido.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>