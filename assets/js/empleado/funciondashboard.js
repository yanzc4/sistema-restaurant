function cards() {
    $.ajax({
      type: "GET",
      url: "../backend/productos/noticias.php",
      success: function (data) {
        $("#glider").html(data);
      },
    });
    return false;
  }
  cards();
  

 