//funcion para buscar ventas
function buscar_ahora(buscar) {
  var parametros = {
    buscar: buscar,
  };
  $.ajax({
    data: parametros,
    type: "POST",
    url: "../backend/admin/listarusuarios.php",
    success: function (data) {
      document.getElementById("datos_buscador").innerHTML = data;
    },
  });
}
buscar_ahora("");

//funcion para buscar categorias
function buscar_categoria(buscarcate) {
  var busca = {
    buscarcate: buscarcate,
  };
  $.ajax({
    data: busca,
    type: "POST",
    url: "../backend/admin/listarcategorias.php",
    success: function (data) {
      document.getElementById("categoria_buscador").innerHTML = data;
    },
  });
}
buscar_categoria("");

//funcion para buscar platos
function buscar_plato(buscarplato) {
  var b = {
    buscarplato: buscarplato,
  };
  $.ajax({
    data: b,
    type: "POST",
    url: "../backend/admin/listarplatos.php",
    success: function (data) {
      document.getElementById("plato_buscador").innerHTML = data;
    },
  });
}
buscar_plato("");

//funcion para insertar usuario
$(document).ready(function () {
  $("#btnagregar").click(function () {
    var datos = $("#frmagregarusuario").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/admin/agregarusuario.php",
      data: datos,
      success: function (r) {
        Swal.fire("Listo", "¡Agregado con exito!", "success");
        buscar_ahora("");
        document.getElementById("frmagregarusuario").reset();
      },
    });
    return false;
  });
});

//funcion para llenar el modal
function llenarmodal_actualizar(datos) {
  d = datos.split("||");
  $("#id").val(d[0]);
  $("#name").val(d[1]);
  $("#apellido").val(d[2]);
  $("#celular").val(d[3]);
  $("#usuario").val(d[4]);
  $("#pass").val(d[5]);
  $("#nivel").val(d[6]);
  $("#nacimiento").val(d[7]);
}

//funcion para actualizar
$(document).ready(function () {
  $("#btnactualizar").click(function () {
    var datos = $("#frmactualizarusuario").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/admin/actualizarusuario.php",
      data: datos,
      success: function (e) {
        Swal.fire("Listo", "¡Actualizado con exito!", "success");
        buscar_ahora("");
      },
    });
    return false;
  });
});

//funcion para eliminar con directo
function eliminacion(codigo) {
  Swal.fire({
    title: "¿Deseas eliminar?",
    text: "¡No podra revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Si, eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      mandar_php(codigo);
    }
  });
}
//codigo para complementar el de eliminar
function mandar_php(codigo) {
  parametros = {
    idv: codigo,
  };
  $.ajax({
    data: parametros,
    url: "../backend/admin/eliminarusuario.php",
    type: "POST",
    beforeSend: function () {},
    success: function (r) {
      document.getElementById("cuerpo-noti").innerHTML = r;
      $("#noti").modal("show");
      buscar_ahora("");
    },
  });
}

//funcion para insertar categoria
$(document).ready(function () {
  $("#btnacategoria").click(function () {
    var datos = $("#frmagregarcategoria").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/admin/agregarcategoria.php",
      data: datos,
      success: function (r) {
        Swal.fire("Listo", "¡Agregado con exito!", "success");
        buscar_categoria("");
        document.getElementById("frmagregarcategoria").reset();
      },
    });
    return false;
  });
});

//funcion para llenar actualizar categoria
function llenarmodal_categoria(categoria) {
  c = categoria.split("||");
  $("#aidcate").val(c[0]);
  $("#acate").val(c[1]);
}

//funcion para actualizar categoria
$(document).ready(function () {
  $("#btnactualizacategoria").click(function () {
    var datos = $("#frmactualizarcategoria").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/admin/actualizarcategoria.php",
      data: datos,
      success: function (e) {
        Swal.fire("Listo", "¡Actualizado con exito!", "success");
        buscar_categoria("");
      },
    });
    return false;
  });
});

//funcion para eliminar categoria con directo
function eliminarcategoria(ccodigo) {
  Swal.fire({
    title: "¿Deseas eliminar?",
    text: "¡No podra revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Si, eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      mandar_eliminar(ccodigo);
    }
  });
}
//codigo para complementar el de eliminar
function mandar_eliminar(ccodigo) {
  parametros = {
    idc: ccodigo,
  };
  $.ajax({
    data: parametros,
    url: "../backend/admin/eliminarcategoria.php",
    type: "POST",
    beforeSend: function () {},
    success: function (r) {
      document.getElementById("cuerpo-noti").innerHTML = r;
      $("#noti").modal("show");
      buscar_categoria("");
    },
  });
}

//funcion para llenar combo categoria
function llenarcombo() {
  $.ajax({
    type: "GET",
    url: "../backend/components/combocategoria.php",
    success: function (data) {
      $("#combocategoria").html(data);
    },
  });
  return false;
}

//funcion para llenar el modal de plato
function llenarmodal_plato(plato) {
  p = plato.split("||");
  $("#aidplato").val(p[0]);
  $("#aplatonom").val(p[1]);
  $("#aplatocategoria").val(p[2]);
  $("#aprecioplato").val(p[3]);
}

//funcion para agregar plato
$(document).ready(function () {
  $("#btnaplato").click(function () {
    var datos = $("#frmagregarplato").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/admin/agregarplato.php",
      data: datos,
      success: function (response) {
        Swal.fire("Listo", "¡Agregado con exito!", "success");
        buscar_plato("");
        document.getElementById("frmagregarplato").reset();
      },
    });
    return false;
  });
});

//funcion para actualizar plato
$(document).ready(function () {
  $("#btnplatoactualizar").click(function () {
    var datos = $("#frmactualizarplato").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/admin/editarplato.php",
      data: datos,
      success: function () {
        Swal.fire("Listo", "¡Actualizado con exito!", "success");
        buscar_plato("");
      },
    });
    return false;
  });
});

//llena el combo para editar funcion para despues
function llenarcomboedit() {
  $.ajax({
    type: "GET",
    url: "../backend/components/comboeditcate.php",
    success: function (data) {
      $("#editcatecombo").html(data);
    },
  });
  return false;
}

//funcion para eliminar plato con directo
function eliminarplato(pcodigo) {
  Swal.fire({
    title: "¿Deseas eliminar?",
    text: "¡No podra revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Si, eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      mandar_plato(pcodigo);
    }
  });
}
//codigo para complementar el de eliminar
function mandar_plato(pcodigo) {
  parametros = {
    idp: pcodigo,
  };
  $.ajax({
    data: parametros,
    url: "../backend/admin/eliminarplato.php",
    type: "POST",
    beforeSend: function () {},
    success: function (r) {
      document.getElementById("cuerpo-noti").innerHTML = r;
      $("#noti").modal("show");
      buscar_plato("");
    },
  });
}
