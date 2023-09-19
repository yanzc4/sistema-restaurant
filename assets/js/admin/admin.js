function cards() {
  $.ajax({
    type: "GET",
    url: "../backend/admin/infoventas.php",
    success: function (data) {
      $("#glider").html(data);
    },
  });
  return false;
}
cards();

