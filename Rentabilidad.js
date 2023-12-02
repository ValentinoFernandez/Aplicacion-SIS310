var data=[];
var dataresults=[];
document.getElementById('calculatorForm').addEventListener('submit', function(event) {
  event.preventDefault();

  var articleNameValue = document.getElementById('articleName').value;
  var articleId = articleNameValue.split('|')[0];
  var articleName = articleNameValue.split('|')[1];
  var utilities = parseFloat(document.getElementById('utilities').value);
  var salesIncome = parseFloat(document.getElementById('salesIncome').value);
  var totalSalesIncome = parseFloat(document.getElementById('totalSalesIncome').value);
  var variableCost = parseFloat(document.getElementById('variableCost').value);

  data.push({articleId: articleId, articleName: articleName, utilities: utilities, salesIncome: salesIncome, totalSalesIncome: totalSalesIncome, variableCost: variableCost});

  addData();

  // Calcular la rentabilidad de ventas, el índice de comerciabilidad y la contribución utilitaria
  var salesProfitability = utilities / salesIncome;
  var tradeIndex = salesIncome / totalSalesIncome;
  var utilityContribution = (salesIncome - variableCost) / salesIncome;

  var conclusion = '';
  if(salesProfitability > 0.6 && tradeIndex > 0.6 && utilityContribution > 0.6) {
    conclusion = 'Excelente rendimiento';
  } else if(salesProfitability > 0.3 && tradeIndex > 0.3 && utilityContribution > 0.3) {
    conclusion = 'Buen rendimiento';
  } else {
    conclusion = 'Rendimiento necesita mejorar';
  }

  dataresults.push({articleId: articleId, articleName: articleName,salesProfitability: salesProfitability, tradeIndex: tradeIndex, utilityContribution: utilityContribution, conclusion: conclusion});

  addDataResults();

});
  
function addData(){
  var dataTable = document.getElementById('data-Table');
  dataTable.innerHTML = '<tr><th>ID</th><th>Artículo</th><th>Utilidades</th><th>Ingreso por Venta</th><th>Ingresos Totales por Venta</th><th>Costo Variable</th></tr>';
    // Reiniciar los arrays antes de agregar los nuevos datos
    for (var i = 0; i < data.length; i++) {
      // Añadir fila a la tabla de datos
      var dataRow = dataTable.insertRow(-1);
      dataRow.insertCell(0).innerHTML = data[i].articleId;
      dataRow.insertCell(1).innerHTML = data[i].articleName;
      dataRow.insertCell(2).innerHTML = data[i].utilities;
      dataRow.insertCell(3).innerHTML = data[i].salesIncome;
      dataRow.insertCell(4).innerHTML = data[i].totalSalesIncome;
      dataRow.insertCell(5).innerHTML = data[i].variableCost;
  }
}

function addDataResults(){
    var dataTable = document.getElementById('resultsTable');
    dataTable.innerHTML = '<tr><th>ID</th><th>Artículo</th><th>Rentabilidad de Ventas</th><th>Índice de Comerciabilidad</th><th>Contribución Utilitaria</th><th>Acciones</th></tr>';
      // Reiniciar los arrays antes de agregar los nuevos datos
      for (var i = 0; i < dataresults.length; i++) {
        // Añadir fila a la tabla de datos
        var dataRow = dataTable.insertRow(-1);
        dataRow.insertCell(0).innerHTML = dataresults[i].articleId;
        dataRow.insertCell(1).innerHTML = dataresults[i].articleName;
        dataRow.insertCell(2).innerHTML = dataresults[i].salesProfitability;
        dataRow.insertCell(3).innerHTML = dataresults[i].tradeIndex;
        dataRow.insertCell(4).innerHTML = dataresults[i].utilityContribution;
        dataRow.insertCell(5).innerHTML = dataresults[i].conclusion;
    }
  }

// Función para recoger los datos de la tabla
function getTableData(tableID) {
    var table = document.getElementById(tableID);
    var data = [];
    // Iterar sobre las filas de la tabla
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var rowData = {};
        // Iterar sobre las celdas de la fila
        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];
            var header = table.rows[0].cells[j].innerText;
            rowData[header] = cell.innerText;
        }
        data.push(rowData);
    }
    return data;
}

document.getElementById('saveTable').addEventListener('click', function(event){
    event.preventDefault();

    // Recoger los datos de las tablas
    var dataTable = getTableData('data-Table');
    var resultsTable = getTableData('resultsTable');

    // Crear un objeto FormData y añadir los datos de las tablas
    var formData = new FormData();
    formData.append('dataTable', JSON.stringify(dataTable));
    formData.append('resultsTable', JSON.stringify(resultsTable));

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'Insertar_Rentabilidad.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Datos guardados correctamente');
        } else {
            alert('Un error ocurrió durante la operación');
        }
    };
    xhr.send(formData);
});

function getTableData(tableID) {
    var table = document.getElementById(tableID);
    var data = [];

    // Check if table exists
    if (!table) {
        console.error('Table with ID ' + tableID + ' does not exist.');
        return data;
    }

    // Iterar sobre las filas de la tabla
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var rowData = {};

        // Iterar sobre las celdas de la fila
        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];

            // Check if header cell exists
            if (!table.rows[0].cells[j]) {
                console.error('Header cell at index ' + j + ' does not exist.');
                continue;
            }

            var header = table.rows[0].cells[j].innerText;
            rowData[header] = cell.innerText;
        }
        data.push(rowData);
    }
    return data;
}
