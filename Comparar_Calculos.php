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
            </select><br>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var empresaSelect = document.getElementById('empresa');
    var productoSelect = document.getElementById('producto');

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
});
</script>

</body>
</html>

