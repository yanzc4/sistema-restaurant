function buscar_ahora(buscar) {
  var parametros = {
    buscar: buscar,
  };
  $.ajax({
    data: parametros,
    type: "POST",
    url: "../backend/inventario/buscarproductos.php",
    success: function (data) {
      document.getElementById("datos_buscador").innerHTML = data;
    },
  });
}
buscar_ahora("");

//funcion para insertar producto
$(document).ready(function () {
  $("#btnaproduc").click(function () {
    var datos = $("#frmagregarproducto").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/inventario/agregarproducto.php",
      data: datos,
      success: function (r) {
        document.getElementById("cuerpo-noti2").innerHTML = r;
        $("#prueba1").click();
        $("#pruebacrear").click();
        buscar_ahora("");
        document.getElementById("frmagregarproducto").reset();
        
      },
    });
    return false;
  });
});

//funcion para llenar combo productos
function llenarcombo() {
  $.ajax({
    type: "GET",
    url: "../backend/components/comboproductos.php",
    success: function (data) {
      $("#comboproducto").html(data);
    },
  });
  return false;
}

//funcion para llenar combo productos salida
function llenarcombo1() {
  $.ajax({
    type: "GET",
    url: "../backend/components/comboproductos1.php",
    success: function (data) {
      $("#comboproducto1").html(data);
    },
  });
  return false;
}
//funcion para insertar addentrada
$(document).ready(function () {
  $("#btnaddentrada").click(function () {
    var datos = $("#frmaddentrada").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/inventario/addentrada.php",
      data: datos,
      success: function (r) {
        document.getElementById("cuerpo-noti2").innerHTML = r;
        $("#prueba1").click();
        $("#pruebaagregar").click();
        buscar_ahora("");
        document.getElementById("frmaddentrada").reset();
      },
    });
    return false;
  });
});

//funcion para insertar addsalida
$(document).ready(function () {
  $("#btnaddsalida").click(function () {
    var datos = $("#frmaddsalida").serialize();
    $.ajax({
      type: "POST",
      url: "../backend/inventario/addsalida.php",
      data: datos,
      success: function (r) {
        document.getElementById("cuerpo-noti2").innerHTML = r;
        $("#prueba1").click();
        $("#prueba").click();
        buscar_ahora("");
        document.getElementById("frmaddsalida").reset();
      },
    });
    return false;
  });
});
