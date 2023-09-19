<!-- Agregar producto Modal -->
<div class="modal fade" id="agregarproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmagregarproducto" method="POST">
                    <label>Producto</label>
                    <input type="text" class="form-control" name="pnom" id="pnom" placeholder="Ingresa nombre del producto">

                    <div class="row mt-3">
                        <div class="d-grid w-50">
                            <button id="btnaproduc" class="btn bg-azul"><i class='bx bxs-add-to-queue'></i> Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Agregar a stock Modal -->
<div class="modal fade" id="addstock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmaddentrada" method="POST">

                    <label>Producto</label>
                    <div id="comboproducto"></div>

                    <?php date_default_timezone_set("America/Lima");
                    $fecha = getdate();
                    $fechad = $fecha['year'] . "-" . $fecha['mon'] . "-" . $fecha['mday']; ?>
                    <input type="hidden" class="form-control" name="entradafecha" id="entradafecha" value="<?php echo $fechad ?>">

                    <div class="row">
                        <div class="col-6">
                            <label>Cantidad</label>
                            <input type="number" class="form-control" name="entradacantidad" id="entradacantidad" placeholder="Ingresa cantidad">
                        </div>
                        <div class="col-6">
                            <label>Precio</label>
                            <input type="number" class="form-control" name="entradaprecio" id="entradaprecio" placeholder="Ingresa precio">
                        </div>
                    </div>

                    <input type="hidden" class="form-control" name="entradausuario" id="entradausuario" value="<?php echo $id ?>">

                    <div class="row mt-3">
                        <div class="d-grid w-50">
                            <button id="btnaddentrada" class="btn bg-azul"><i class='bx bxs-add-to-queue'></i> Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Agregar a salida Modal -->
<div class="modal fade" id="addsalida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Retirar stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmaddsalida" method="POST">

                    <div class="row">
                        <div class="col-6">
                            <label>Producto</label>
                            <div id="comboproducto1"></div>
                        </div>
                        <div class="col-6">
                            <label>Cantidad</label>
                            <input type="number" class="form-control" name="salidacantidad" id="salidacantidad" placeholder="Ingresa cantidad">
                        </div>
                    </div>

                    <input type="hidden" class="form-control" name="salidafecha" id="salidafecha" value="<?php echo $fechad ?>">

                    <input type="hidden" class="form-control" name="salidausuario" id="salidausuario" value="<?php echo $id ?>">

                    <div class="row mt-3">
                        <div class="d-grid w-50">
                            <button id="btnaddsalida" class="btn bg-azul"><i class='bx bxs-add-to-queue'></i> Retirar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

