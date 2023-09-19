const ctx = document.getElementById("myChart");
const ctx2 = document.getElementById("myChart2");
const ctx3 = document.getElementById("myChart3");
const ctx4 = document.getElementById("myChart4");

//grafico dinero
(async () => {
    // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
    const respuestaRaw = await fetch("../backend/apis/ventasmensuales.php");
    // Decodificar como JSON
    const respuesta = await respuestaRaw.json();
    // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
    // Obtener una referencia al elemento canvas del DOM
    new Chart(ctx, {
        type: "line",
        data: {
          labels: respuesta.etiquetas,
          datasets: [
            {
              label: "Ventas mensuales",
              data: respuesta.datos,
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
})();

//grafico platos
(async () => {
    // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
    const platos = await fetch("../backend/apis/topplatos.php");
    // Decodificar como JSON
    const topplatos = await platos.json();
    // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
    // Obtener una referencia al elemento canvas del DOM
    new Chart(ctx2, {
        type: "bar",
        data: {
          labels: topplatos.etiquetas,
          datasets: [
            {
              label: "Top platos",
              data: topplatos.datos,
              backgroundColor: ["#758AF5", "#FC9A97", "#353A57", "#70DBEF", "#70DBEF"],
              borderColor: ["#ffffff"],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
})();


//top categorias
(async () => {
  // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
  const categorias = await fetch("../backend/apis/topcategorias.php");
  // Decodificar como JSON
  const topcategorias = await categorias.json();
  // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
  // Obtener una referencia al elemento canvas del DOM
  new Chart(ctx3, {
    type: "line",
    data: {
      labels: topcategorias.etiquetas,
      datasets: [
        {
          label: "Top categorias",
          data: topcategorias.datos,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });  
})();


//grafico empleados
(async () => {
  // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
  const empleados = await fetch("../backend/apis/topempleados.php");
  // Decodificar como JSON
  const topempleados = await empleados.json();
  // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
  // Obtener una referencia al elemento canvas del DOM
  new Chart(ctx4, {
    type: "bar",
    data: {
      labels: topempleados.etiquetas,
      datasets: [
        {
          label: "Top empleados",
          data: topempleados.datos,
          backgroundColor: ["#758AF5", "#FC9A97", "#353A57", "#70DBEF"],
          borderColor: ["#ffffff"],
          borderWidth: 1,
        },
      ],
    },
  });
})();




