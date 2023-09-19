function buscar_ahora(buscar) {
  var parametros = {
    buscar: buscar,
  };
  $.ajax({
    data: parametros,
    type: "POST",
    url: "backend/pedidos/buscador_plato.php",
    success: function (data) {
      document.getElementById("datos_buscador").innerHTML = data;
    },
  });
}
buscar_ahora("");

//para llamar los datos de la tabla detalle
function tabladetalle() {
  var datos = $("#idve");
  $.ajax({
    data: datos,
    type: "POST",
    url: "backend/pedidos/detalleventa.php",
    success: function (data) {
      document.getElementById("detalle_tabla").innerHTML = data;
    },
  });
}
tabladetalle();

//funcion llenar cajas de informacion
function llenarcajas(datos) {
  d = datos.split("||");
  $("#cplato").val(d[0]);
  $("#cprecio").val(d[1]);
  $("#pcantidad").val("1");
  $("#pdsc").val("0.00");
}

//para llamar los datos del total a pagar
function totalpagar() {
  var datos = $("#idve");
  $.ajax({
    data: datos,
    type: "POST",
    url: "backend/pedidos/totalpagar.php",
    success: function (data) {
      document.getElementById("totalpagar").innerHTML = data;
    },
  });
  return false;
}
totalpagar();

//funcion para insertar detalle
$(document).ready(function () {
  $("#btnnuevodetalle").click(function () {
    var datos = $("#frmdetalle").serialize();
    $.ajax({
      type: "POST",
      url: "backend/pedidos/creardetalle.php",
      data: datos,
      success: function () {
        Swal.fire("Listo", "¡Agregado con exito!", "success");
        totalpagar();
        tabladetalle();
      },
    });
    return false;
  });
});

//funcion para eliminar con directo
function eliminacion(vcod, pcod) {
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
      mandar_php(vcod, pcod);
    }
  });
}
//codigo para complementar el de eliminar
function mandar_php(vcod, pcod) {
  parametros = {
    idv: vcod,
    idp: pcod,
  };
  $.ajax({
    data: parametros,
    url: "backend/pedidos/eliminardetalle.php",
    type: "POST",
    beforeSend: function () {},
    success: function () {
      Swal.fire("Eliminado!", "Plato eliminado", "success").then(
        (result) => {
          totalpagar();
          tabladetalle();
        }
      );
    },
  });
}
