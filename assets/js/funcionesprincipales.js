//funcion para actualizar
$(document).ready(function () {
    $("#btnpass").click(function () {
      var datos = $("#login-form").serialize();
      $.ajax({
        type: "POST",
        url: "../backend/admin/actualizarusuario.php",
        data: datos,
        success: function (e) {
          Swal.fire("Listo", "¡Actualizado con exito!", "success");
          $(".modal").toggle();
        },
      });
      return false;
    });
  });