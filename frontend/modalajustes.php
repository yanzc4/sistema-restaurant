        <!-- Modal agregar usuario -->
        <div class="modal fade" id="nuevousuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmagregarusuario" method="POST">
                            <div class="d-flex">
                                <div class="w-50 me-2">
                                    <label>Codigo</label>
                                    <input maxlength="4" type="text" class="form-control" id="codigo" name="codigo" value="">
                                </div>
                                <div class="w-50">
                                    <label>Rol</label>
                                    <select name="rol" id="rol" class="form-control">
                                        <option value="Administrador">Administrador</option>
                                        <option value="Empleado" selected>Empleado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex mt-1">
                                <div class="w-50 me-2">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="">
                                </div>
                                <div class="w-50">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" name="aapellido" id="aapellido">
                                </div>
                            </div>

                            <div class="d-flex mt-1">
                                <div class="w-50 me-2">
                                    <label>Fecha Nacimiento</label>
                                    <input type="date" class="form-control w-100" name="fecha" id="fecha">
                                </div>
                                <div class=" w-50">
                                    <label>Celular</label>
                                    <input maxlength="9" type="text" class="form-control" id="acelular" name="acelular" value="">
                                </div>
                            </div>

                            <div class="d-flex mt-1">
                                <div class="w-50 me-2">
                                    <label>Usuario</label>
                                    <input type="text" class="form-control" name="user" id="user">
                                </div>
                                <div class="w-50">
                                    <label>Contraseña</label>
                                    <input type="text" class="form-control" id="apass" name="apass" value="">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="d-grid w-50">
                                    <button id="btnagregar" class="btn bg-azul"><i class='bx bx-user-plus'></i> Agregar</button>
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

        <!-- Editar usuario Modal -->
        <div class="modal fade" id="actualizarusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmactualizarusuario" method="POST">
                            <div class="d-flex">
                                <div class="w-50 me-2">
                                    <label>Codigo</label>
                                    <input maxlength="4" type="text" class="form-control" id="id" name="id" value="">
                                </div>
                                <div class="w-50">
                                    <label>Rol</label>
                                    <select name="nivel" id="nivel" class="form-control">
                                        <option value="Administrador">Administrador</option>
                                        <option value="Empleado">Empleado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex mt-1">
                                <div class="w-50 me-2">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" value="">
                                </div>
                                <div class="w-50">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido">
                                </div>
                            </div>

                            <div class="d-flex mt-1">
                                <div class="w-50 me-2">
                                    <label>Fecha Nacimiento</label>
                                    <input type="date" class="form-control w-100" name="nacimiento" id="nacimiento">
                                </div>
                                <div class="w-50">
                                    <label>Celular</label>
                                    <input maxlength="9" type="text" class="form-control" id="celular" name="celular" value="">
                                </div>
                            </div>

                            <div class="d-flex mt-1">
                                <div class="w-50 me-2">
                                    <label>Usuario</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario">
                                </div>
                                <div class="w-50">
                                    <label>Contraseña</label>
                                    <input type="text" class="form-control" id="pass" name="pass" value="">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="d-grid w-50">
                                    <button id="btnactualizar" class="btn bg-azul"><i class='bx bx-user-plus'></i> Actuaizar</button>
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

        <!-- Agregar Categoria Modal -->
        <div class="modal fade" id="agregarcategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmagregarcategoria" method="POST">
                            <label>Categoria</label>
                            <input type="text" class="form-control" name="icate" id="icate" placeholder="Ingresa nombre de categoria">

                            <div class="row mt-3">
                                <div class="d-grid w-50">
                                    <button id="btnacategoria" class="btn bg-azul"><i class='bx bxs-add-to-queue'></i> Agregar</button>
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


        <!-- Actualizar Categoria Modal -->
        <div class="modal fade" id="actualizarcategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmactualizarcategoria" method="POST">
                            <input type="hidden" class="form-control" name="aidcate" id="aidcate">
                            <label>Categoria</label>
                            <input type="text" class="form-control" name="acate" id="acate" placeholder="Ingresa nombre de categoria">

                            <div class="row mt-3">
                                <div class="d-grid w-50">
                                    <button id="btnactualizacategoria" class="btn bg-azul"><i class='bx bxs-edit-alt'></i> Actualizar</button>
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



        <!-- Agregar plato Modal -->
        <div class="modal fade" id="agregarplato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Plato</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmagregarplato" method="POST">

                            <label>Plato</label>
                            <input type="text" class="form-control" name="platonom" id="platonom" placeholder="Ingresar nombre del plato">

                            <label>Categoria</label>
                            <div id="combocategoria"></div>

                            <label>Precio</label>
                            <input type="number" class="form-control" name="precioplato" id="precioplato" placeholder="Ingresar precio">

                            <div class="row mt-3">
                                <div class="d-grid w-50">
                                    <button id="btnaplato" class="btn bg-azul"><i class='bx bxs-add-to-queue'></i> Agregar</button>
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


        <!-- Actualizar Plato Modal -->
        <div class="modal fade" id="actualizarplato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmactualizarplato" method="POST">
                        <input type="hidden" class="form-control" name="aidplato" id="aidplato">
                        <input type="hidden" class="form-control" name="aplatocategoria" id="aplatocategoria">
                        <!--<div id="editcatecombo"></div>-->
                            <label>Plato</label>
                            <input type="text" class="form-control" name="aplatonom" id="aplatonom">

                            <label>Precio</label>
                            <input type="number" class="form-control" name="aprecioplato" id="aprecioplato">


                            <div class="row mt-3">
                                <div class="d-grid w-50">
                                    <button id="btnplatoactualizar" class="btn bg-azul"><i class='bx bxs-add-to-queue'></i> Actualizar</button>
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

        <div class="modal fade" id="noti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body" id="cuerpo-noti">


                    </div>
                </div>
            </div>
        </div>