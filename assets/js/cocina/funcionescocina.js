function buscar_ahora(buscar) {
    var parametros = {
      buscar: buscar,
    };
    $.ajax({
      data: parametros,
      type: "POST",
      url: "../backend/cocina/listadepedidos.php",
      success: function (data) {
        document.getElementById("datos_buscador").innerHTML = data;
      },
    });
  }
  buscar_ahora("");
setInterval('buscar_ahora("")', 10000);

  //funcion cambiar color a la fila
    function aceptarpedido(cod) {
      Swal.fire({
        title: "¿Cambiar estado?",
        text: "¡El estado es temporal!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Si, cambiar!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          aceptar(cod);
        }
      });
    }
    //codigo para complementar el de eliminar
    function aceptar(cod) {
      parametros = {
        idv: cod,
      };
      $.ajax({
        data: parametros,
        url: "../backend/cocina/cambiacolor.php",
        type: "POST",
        beforeSend: function () {},
        success: function () {
          Swal.fire("Aceptado!", "Continue con sus labores", "success").then(
            (result) => {
              buscar_ahora("");
            }
          );
        },
      });
    }


//funcion para eliminar
    function eliminacion(codigo) {
        Swal.fire({
          title: "¿Quiere entregar el pedido?",
          text: "¡No podra revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "¡Si, entregar!",
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
          url: "../backend/cocina/eliminarlista.php",
          type: "POST",
          beforeSend: function () {},
          success: function () {
            Swal.fire("Entregado!", "El pedido ah sido entregado", "success").then(
              (result) => {
                buscar_ahora("");
              }
            );
          },
        });
      }