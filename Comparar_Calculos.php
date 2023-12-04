<?php
include 'db_conexion.php';

// Obtener empresas
$sqlEmpresas = "SELECT id, nombre FROM Empresas";
$resultEmpresas = $conn->query($sqlEmpresas);
$empresas = $resultEmpresas->fetch_all(MYSQLI_ASSOC);

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>

    <label >Empresas guardadas</label><br>
    <select id="empresa">
        <option>Seleccione una Empresa</option>
        <?php
        foreach ($empresas as $empresa) {
            echo "<option value='".$empresa['id']."'>".$empresa['nombre']."</option>";
        }
        ?>
    </select>
<br>

    <label>Productos:</label><br>
    <select id="producto">
        <option>Seleccione un producto</option>
    </select>
<br>

    <label >Comparación de calculos</label><br>
        <select class="right.align" name="calculos" id=comparación>
            <option value="">Elegir Tipo de comparación</option>
            <option value="Pareto">Pareto</option>
            <option value="Rentabilidad">Rentabilidad</option>
            </select><br>


    <label class="right.align" for="Gestion">Gestion: </label><br>
        <select class="right.align" name="Gestion" id="gestion">
            <option value="">Elegir Gestion</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            </select>
            <br>

    <button id="compare">Compare</button>
     <br>

    <table id="results">
    <!-- Results will be populated here -->
    </table>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var empresaSelect = document.getElementById('empresa');
    var productoSelect = document.getElementById('producto');
    var gestionSelect = document.getElementById('gestion');
    var comparacionSelect = document.getElementById('comparación');
    var comparaButton = document.getElementById('compare');
    var resultsTable = document.getElementById('results');

    // Evento cuando se cambia la empresa seleccionada
    empresaSelect.addEventListener('change', function() {
        var empresaId = empresaSelect.value;

        // Limpiar opciones de producto
        while (productoSelect.firstChild) {
            productoSelect.removeChild(productoSelect.firstChild);
        }

        // Si se seleccionó una empresa, obtener sus productos
        if (empresaId != "") {
            fetch('getProductos.php?empresa_id=' + empresaId)
                .then(response => response.json())
                .then(productos => {
                    // Llenar opciones de producto para la empresa seleccionada
                    productos.forEach(function(producto) {
                        var option = document.createElement('option');
                        option.value = producto.id;
                        option.textContent = producto.nombre;
                        productoSelect.appendChild(option);
                    });
                });
        }
    });

    // Evento cuando se hace clic en "Compara"
    comparaButton.addEventListener('click', function() {
        var empresaId = empresaSelect.value;
        var productoId = productoSelect.value;
        var comparacionId = comparacionSelect.value;
        var gestionId = gestionSelect.value;

        if (empresaId !== "" && productoId !== "" && comparacionId !== "" && gestionId !== "") {
            fetch('getDatos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'empresaId=' + empresaId + '&productoId=' + productoId + '&gestionId=' + gestionId + '&calculoId=' + comparacionId
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(datos => {
                // Limpiar resultados anteriores
                while (resultsTable.firstChild) {
                    resultsTable.removeChild(resultsTable.firstChild);
                }

                // Mostrar nuevos resultados en la tabla
                datos.forEach(function(dato) {
                    var row = document.createElement('tr');
                    var cell1 = document.createElement('td');
                    var cell2 = document.createElement('td');
                    cell1.textContent = dato.mes;

                    // Seleccionar el valor correcto según el tipo de comparación
                    if (comparacionId === "Pareto") {
                        cell2.textContent = dato.ingreso_venta;
                    } else if (comparacionId === "Rentabilidad") {
                        cell2.textContent = dato.rentabilidad;
                    }

                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    resultsTable.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Hubo un problema con la operación de fetch:', error);
            });
        }
    });
})
        
    </script>


</body>
</html>

