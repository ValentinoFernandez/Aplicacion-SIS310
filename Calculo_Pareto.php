<?php
include 'db_conexion.php';

$companyId = $_GET['id'];

$sql = "SELECT nombre FROM Empresas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $companyId);
$stmt->execute();
$result = $stmt->get_result();
$company = $result->fetch_assoc();

$sql = "SELECT nombre FROM Productos WHERE id_empresa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $companyId);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="Style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Asegúrate de tener Chart.js -->
<head>
    <h1><?php echo $company['nombre']; ?></h1>
</head>
<body>

    <h2>Ingresar Datos</h2>
    <form id="data-form">
    
    <label class="right.align" for="Gestion">Gestion</label><br>
        <select class="right.align" name="Gestion" id="Gestion">
            <option value="">Elegir Gestion</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            </select><br>

        <label class="right.align" for="Mes">Mes</label><br>
        <select class="right.align" name="Mes" id="Mes">
            <option value="">Elegir Mes</option>
            <option value="Enero">Enero</option>
            <option value="Febrero">Febrero</option>
            <option value="Marzo">Marzo</option>
            <option value="Abril">Abril</option>
            <option value="Mayo">Mayo</option>
            <option value="Junio">Junio</option>
            <option value="Julio">Julio</option>
            <option value="Agosto">Agosto</option>
            <option value="Septiembre">Septiembre</option>
            <option value="Octubre">Octubre</option>
            <option value="Noviembre">Noviembre</option>
            <option value="Diciembre">Diciembre</option>
        </select><br>
    
        <label class="right.align" for="nombre">Nombre del Artículo:</label><br>
    <?php
            echo '<select name="nombre" id="nombre">';
            echo '<option value="">Elegir un articulo</option>';
            foreach ($products as $index => $product)  {
            echo '<option value="' . $product['nombre'] . '">' . $product['nombre'] . '</option>';
        }
            echo '</select>';
     ?>
            <br>

        <label for="unidades">Unidades:</label><br>
        <input type="number" id="unidades" name="unidades"><br>
        <label for="precio">Precio Unitario:</label><br>
        <input type="number" id="precio" name="precio"><br>
        <input type="submit" value="Añadir datos">
    </form>

<h2>Tabla de Datos</h2>
<table id="data-table">
  <tr>
    <th>Nombre</th>
    <th>Unidades</th>
    <th>Precio Unitario</th>
    <th>Ventas</th>
  </tr>
</table>

<h2>Tabla de Resultados</h2>
<table id="results-table">
  <tr>
    <th>Nombre</th>
    <th>Ventas Totales</th>
    <th>Porcentaje Acumulado</th>
    <th>Porcentaje Acumulado %</th>
  </tr>
</table>

<!-- Gráfico de Pareto -->
<h2>Gráfico de Pareto</h2>
<canvas id="pareto-chart"></canvas>

<script>
var data = [];
var paretoChart; // Variable para almacenar la instancia del gráfico de Pareto

document.getElementById('data-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var nombre = document.getElementById('nombre').value;
    var unidades = document.getElementById('unidades').value;
    var precio = document.getElementById('precio').value;
    var ventas = unidades * precio;
    
    data.push({nombre: nombre, unidades: unidades, precio: precio, ventas: ventas});
    
    addData();
});

function addData() {
    var dataTable = document.getElementById('data-table');
    var resultsTable = document.getElementById('results-table');
    
    // Limpiar tablas
    dataTable.innerHTML = '<tr><th>Nombre</th><th>Unidades</th><th>Precio Unitario</th><th>Ventas</th></tr>';
    resultsTable.innerHTML = '<tr><th>Nombre</th><th>Ventas Totales</th><th>Porcentaje Acumulado</th><th>Porcentaje Acumulado %</th></tr>';
    
    // Ordenar datos por ventas
    data.sort((a, b) => b.ventas - a.ventas);
    
    var totalVentas = data.reduce((total, item) => total + item.ventas, 0);
    var acumulado = 0;
    
    var nombres = [];
    var ventasTotales = [];
    var porcentajesAcumulados = [];
    
    // Reiniciar los arrays antes de agregar los nuevos datos
    for (var i = 0; i < data.length; i++) {
        // Añadir fila a la tabla de datos
        var dataRow = dataTable.insertRow(-1);
        dataRow.insertCell(0).innerHTML = data[i].nombre;
        dataRow.insertCell(1).innerHTML = data[i].unidades;
        dataRow.insertCell(2).innerHTML = data[i].precio;
        dataRow.insertCell(3).innerHTML = data[i].ventas;
        
        // Calcular porcentaje acumulado
        acumulado += data[i].ventas;
        var porcentaje = acumulado / totalVentas * 100;
        
        // Añadir fila a la tabla de resultados
        var resultsRow = resultsTable.insertRow(-1);
        resultsRow.insertCell(0).innerHTML = data[i].nombre;
        resultsRow.insertCell(1).innerHTML = data[i].ventas;
        resultsRow.insertCell(2).innerHTML = acumulado;
        resultsRow.insertCell(3).innerHTML = porcentaje.toFixed(2) + '%';
        
        // Añadir datos para el gráfico
        nombres.push(data[i].nombre);
        ventasTotales.push(data[i].ventas);
        porcentajesAcumulados.push(porcentaje);
    }
    
    // Si el gráfico de Pareto ya existe, destrúyelo antes de crear uno nuevo
    if (paretoChart) {
        paretoChart.destroy();
    }

    // Crear gráfico de Pareto
    var ctx = document.getElementById('pareto-chart').getContext('2d');
    paretoChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombres,
            datasets: [{
                label: 'Ventas Totales',
                data: ventasTotales,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Porcentaje Acumulado',
                data: porcentajesAcumulados,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                type: 'line',
                fill: false,
                yAxisID: 'y-axis-2'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                'y-axis-2': {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true
                }
            }
        }
    });
}
</script>

</body>
</html>
