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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .foto {
            width: 100%;
            height: 26vh;
            padding: 0;
        }

        .titulo {
            font-size: 40px;
            font-weight: bold;
            color: #707070;
        }
        .bg-gris{
            background-color: #e0e0e0;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h1 class="titulo">Novedades</h1>
        <div class="row" id="glider"></div>

        <div class="container bg-primary">
            <form id="noticia" action="../backend/productos/insertarnoticia.php" method="post" enctype="multipart/form-data">
                <input class="form-control" placeholder="titulo" type="text" name="titulo" id="titulo">
                <input class="form-control" type="file" name="image" id="image">
                <?php

                ?>

                <div class="form-floating">
                    <textarea class="form-control" style="resize:none; height:100px;" name="cuerpo" id="cuerpo"></textarea>
                    <label for="floatingTextarea">comentarios</label>
                </div>
                <button name="btn" class="btn btn-primary" type="submit">Publicar</button>

            </form>
        </div>
    </div>



    <script src="../assets/js/empleado/funciondashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>

    </script>
</body>

</html>