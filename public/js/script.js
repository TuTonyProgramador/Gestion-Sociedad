var canariosPorAnio = JSON.parse(document.currentScript.getAttribute('data-canarios'));

var labels = canariosPorAnio.map(function (data) {
    return data.anio;
});

var data = canariosPorAnio.map(function (data) {
    return data.total;
});

var ctx = document.getElementById('graficoCanariosPorAnio').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Canarios por Año',
            data: data,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100, // Establece el máximo del eje Y en 100
                ticks: {
                    stepSize: 5, // Establece el paso en la escala Y a 5
                }
            }
        }
    }
});

function validacion(input) {
    var valorInput = input.value; 
    var error = ""; 

    switch (input.id) {
        case 'numeroCriador':
            if (!/^[A-Z\s]{1,4}$/.test(valorInput)) {
                error = "El campo número de criador no es válido.";
            }
            break;
        case 'nombre':
            if (!/^[a-zA-Z\s]+$/.test(valorInput)) {
                error = "El campo nombre no es valido.";
            }
            break;
        case 'apellidos':
            if (!/^[a-zA-Z\s]+$/.test(valorInput)) {
                error = "El campo apellidos no es valido.";
            }
            break;
        case 'fechaNacimiento':

            break;
        case 'localidad':
            if (!/^[a-zA-Z\s]+$/.test(valorInput)) {
                error = "El campo localidad no es valido.";
            }
            break;
        case 'telefono':
            if (!/^\d{9}$/.test(valorInput)) {
                error = "El telefono no es válido.";
            }
            break;
        case 'fechaConcurso':
            error = validarFechaConcurso(valorInput);
            break;
        case 'sede':
            if (!/^[a-zA-Z\s]+$/.test(valorInput)) {
                error = "El campo sede no es valido.";
            }
            break;
        case 'ubicacion':
            if (!/^[a-zA-Z\s]+$/.test(valorInput)) {
                error = "El campo ubicacion no es valido.";
            }
            break;
        case 'nombreRaza':
            if (!/^[a-zA-Z\s]+$/.test(valorInput)) {
                error = "El campo nombreRaza no es valido.";
            }
            break;
        case 'sexo':
            if (!/^[a-zA-Z\s]+$/.test(valorInput)) {
                error = "El campo sexo no es valido.";
            }
            break;
    }

    document.getElementById('alert-danger').innerHTML = error;
}

function validarFechaConcurso(fechaConcurso) {
    // Obtener la fecha actual
    var fechaActual = new Date();
    // Convertir la fecha de concurso a objeto Date
    var fechaInput = new Date(fechaConcurso);
    error = "";

    // Comparar las fechas
    if (fechaInput < fechaActual) {
        // La fecha de concurso es anterior a la fecha actual, lanzar una excepción
        error = "La fecha de concurso no puede ser anterior a la fecha actual.";
    } 
    
    return error;
}

window.onload = function() {
   
}; 

