<?php
include 'db_conexion.php';

// Decodificar los datos de las tablas
$dataTable = json_decode($_POST['dataTable'], true);
$resultsTable = json_decode($_POST['resultsTable'], true);

// Iterar sobre los datos de las tablas e insertarlos en la base de datos
foreach ($dataTable as $row) {
    $id_producto = $row['ID'];
    $nombre_producto = $row['Artículo'];
    $utilidades = $row['Utilidades'];
    $Ingresos_por_venta = $row['Ingreso por Venta'];
    $Total_ingresos_por_venta = $row['Ingresos Totales por Venta'];
    $costo_variable = $row['Costo Variable'];

    // Aquí necesitarás buscar el correspondiente resultado para este producto en $resultsTable

    $sql = "INSERT INTO rentabilidad (id_producto, Gestion, utilidades, Ingresos_por_venta, Total_ingresos_por_venta, costo_variable, rentabilidad, indice_comerciabilidad, contribucion_utilitaria, Mes)
    VALUES ('$id_producto', '$Gestion', '$utilidades', '$Ingresos_por_venta', '$Total_ingresos_por_venta', '$costo_variable', '$rentabilidad', '$indice_comerciabilidad', '$contribucion_utilitaria', '$Mes')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
