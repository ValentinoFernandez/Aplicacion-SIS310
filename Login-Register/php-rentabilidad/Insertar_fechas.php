<?php
include 'db_conexion.php';

    $productId = $_POST['articleName'];
    $year = $_POST['Gestion'];
    $utilities = $_POST['utilities'];
    $variableCost = $_POST['variableCost'];
    $salesIncome = $_POST['salesIncome'];
    $totalSalesIncome = $_POST['totalSalesIncome'];
    $month = $_POST['Mes'];

    // Assuming you have calculated these values in your JavaScript file and included them in your form
    $profitability = $_POST['profitability'];
    $tradeIndex = $_POST['tradeIndex'];
    $utilityContribution = $_POST['utilityContribution'];

    $sql = "INSERT INTO rentabilidad (id_producto, Gestion, utilidades, costo_variable, rentabilidad, indice_comerciabilidad, contribucion_utilitaria, Mes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiddiids", $productId, $year, $utilities, $variableCost, $profitability, $tradeIndex, $utilityContribution, $month);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    
?>
