<?php
header('Content-Type: application/json');
$empresaId = $_POST['empresaId'];
// Aquí debes establecer la conexión con tu base de datos

include 'db_conexion.php';

 $sql = "SELECT id, nombre FROM productos WHERE id_empresa = $empresaId";
 $result = $conn->query($sql);
 $productos = array();
 while($row = $result->fetch_assoc()) {
     $productos[] = $row;
 }
 echo json_encode($productos);
?>
