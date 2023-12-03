<?php
include 'db_conexion.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <select id="empresa">
        <option value="">Selecciona una empresa</option>
        <!-- Las opciones de las empresas se llenarán aquí con AJAX -->
    </select>

    <select id="producto">
        <option value="">Selecciona un producto</option>
        <!-- Las opciones de los productos se llenarán aquí con AJAX -->
    </select>

    <select id="gestion">
        <option value="">Selecciona una gestión</option>
        <!-- Las opciones de las gestiones se llenarán aquí con AJAX -->
    </select>

    <select id="calculo">
        <option value="">Selecciona un cálculo</option>
        <option value="pareto">Pareto</option>
        <option value="rentabilidad">Rentabilidad</option>
    </select>

    <button id="listo">Listo</button>

    <table id="datos">
        <!-- Los datos se mostrarán aquí -->
    </table>

<script>
$(document).ready(function(){
    $('#empresa').change(function(){
        var empresaId = $(this).val();
        if(empresaId != ""){
            $.ajax({
                url: 'getProductos.php',
                type: 'post',
                data: {empresaId: empresaId},
                dataType: 'json',
                success: function(response){
                    var len = response.length;
                    $("#producto").empty();
                    for( var i = 0; i<len; i++){
                        var id = response[i]['id'];
                        var nombre = response[i]['nombre'];
                        $("#producto").append("<option value='"+id+"'>"+nombre+"</option>");
                    }
                }
            });
        }
    });

    // Similarmente, puedes hacer esto para gestion y calculo

    $('#listo').click(function(){
        var empresaId = $('#empresa').val();
        var productoId = $('#producto').val();
        var gestionId = $('#gestion').val();
        var calculoId = $('#calculo').val();

        if(empresaId == "" || productoId == "" || gestionId == "" || calculoId == ""){
            alert("Por favor, selecciona todas las opciones");
        } else {
            $.ajax({
                url: 'getDatos.php',
                type: 'post',
                data: {empresaId: empresaId, productoId: productoId, gestionId: gestionId, calculoId: calculoId},
                dataType: 'json',
                success: function(response){
                    var len = response.length;
                    $("#datos").empty();
                    for( var i = 0; i<len; i++){
                        var mes = response[i]['mes'];
                        var valor = response[i]['valor'];
                        $("#datos").append("<tr><td>"+mes+"</td><td>"+valor+"</td></tr>");
                    }
                }
            });
        }
    });
});
</script>

</body>
</html>
