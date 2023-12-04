<?php
header('Content-Type: application/json');

$empresaId = $_POST['empresaId'];
$productoId = $_POST['productoId'];
$gestionId = $_POST['gestionId'];
$calculoId = $_POST['calculoId'];

include 'db_conexion.php';

$response = array(); // Crear un array para la respuesta

if ($calculoId == "pareto") {
    $sql = "SELECT mes, ingreso_venta FROM pareto WHERE id_producto = $productoId AND Gestion = $gestionId";
} elseif ($calculoId == "rentabilidad") {
    $sql = "SELECT mes, rentabilidad, indice_comerciabilidad, contribucion_utilitaria FROM rentabilidad WHERE id_producto = $productoId AND Gestion = $gestionId";
} else {
    $response['error'] = 'Cálculo no válido'; // Manejar casos de cálculos no válidos
    echo json_encode($response);
    exit();
}

$result = $conn->query($sql);

if ($result) {
    $datos = array();
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
    $response['data'] = $datos; // Incluir datos en la respuesta
} else {
    $response['error'] = 'Error en la consulta: ' . $conn->error; // Incluir mensaje de error en la respuesta
}

echo json_encode($response);
$conn->close();
?>
