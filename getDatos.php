<?php
header('Content-Type: application/json');
$empresaId = $_POST['empresaId'];
$productoId = $_POST['productoId'];
$gestionId = $_POST['gestionId'];
$calculoId = $_POST['calculoId'];
// Aquí debes establecer la conexión con tu base de datos
include 'db_conexion.php';

 if($calculoId == "pareto"){
     $sql = "SELECT mes, ingreso_venta FROM pareto WHERE id_producto = $productoId AND Gestion = $gestionId";
 } else if($calculoId == "rentabilidad"){
     $sql = "SELECT mes, rentabilidad, indice_comerciabilidad, contribucion_utilitaria FROM rentabilidad WHERE id_producto = $productoId AND Gestion = $gestionId";
 }
 $result = $conn->query($sql);
 $datos = array();
 while($row = $result->fetch_assoc()) {
     $datos[] = $row;
 }
 echo json_encode($datos);
?>
