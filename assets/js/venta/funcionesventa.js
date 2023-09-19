//funcion para buscar ventas
function buscar_ahora(buscar) {
  var parametros = {
    buscar: buscar,
  };
  $.ajax({
    data: parametros,
    type: "POST",
    url: "backend/ventas/buscarventas.php",
    success: function (data) {
      document.getElementById("datos_buscador").innerHTML = data;
    },
  });
}
buscar_ahora("");

//funcion para insertar venta
$(document).ready(function () {
  $("#btnguardar").click(function () {
    var datos = $("#frmajax").serialize();
    $.ajax({
      type: "POST",
      url: "backend/ventas/insertarventa.php",
      data: datos,
      success: function (r) {
        document.getElementById("cuerpo-noti").innerHTML = r;
        $('#noti').modal('show'); // abrir
        buscar_ahora("");
        document.getElementById("frmajax").reset();
      },
    });
    return false;
  });
});

//funcion para llenar el modal
function llenarmodal_actualizar(datos) {
  d = datos.split("||");
  $("#idv").val(d[0]);
  $("#code").val(d[1]);
  $("#fecha").val(d[2]);
  $("#ncliente").val(d[3]);
}

//funcion para actualizar
$(document).ready(function () {
  $("#btnactualizar").click(function () {
    var datos = $("#frmactualizar").serialize();
    $.ajax({
      type: "POST",
      url: "backend/ventas/actualizarventa.php",
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
    url: "backend/ventas/eliminarventa.php",
    type: "POST",
    success: function (r) {
      document.getElementById("cuerpo-noti").innerHTML = r;
      $('#noti').modal('show'); // abrir
      buscar_ahora("");
    },
  });
}

//funcion para eliminar venta
/*
$(document).ready(function () {
  $("#btneliminar").click(function () {
    var datos = $("#frmactualizar").serialize();
    $.ajax({
      type: "POST",
      url: "backend/ventas/eliminarventa.php",
      data: datos,
      success: function (e) {
        if (e == 1) {
          alert("Registro eliminado");
        } else {
          alert("Error esta venta tiene pedidos");
        }
      },
    });
    return false;
  });
});
*/
