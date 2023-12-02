<?php
 include 'conexion_be.php';

//$sql = "SELECT id, nombre FROM Empresas";
//$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="assets/css/Style.css">

<head>
    <title>Biblioteca de empresas</title>
</head>
<body>
<h1>Bienvenido '<?php echo $usuario; ?>': Biblioteca de empresas</h1>

    <table>
        <tr>
            <th>Nombre empresa</th>
            <th>Ver</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php
       /*if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td><button class='ver' data-id='" . $row["id"] . "'>Ver</button></td>";
                echo "<td><button class='editar' data-id='" . $row["id"] . "'>Editar</button></td>";
                echo "<td><button class='eliminar' action='Eliminar.php' data-id='" . $row["id"] . "'>Eliminar</button></td>";
                echo "</tr>";
            }
        } else {
            echo "0 resultados";
        }
        $conn->close();*/
        ?>
    </table>
    <a href="php-rentabilidad/crear_empresa.php" class="nav-item">Crear Empresa</a>
    <script src="Funciones_Menu.js" charset="UTF-8"></script>
</body>
</html>
