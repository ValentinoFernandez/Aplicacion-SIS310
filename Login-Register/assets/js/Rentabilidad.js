var data=[];
document.getElementById('calculatorForm').addEventListener('submit', function(event) {
  event.preventDefault();

  var Gestion = document.getElementById('Gestion').value;
  var Mes = document.getElementById('Mes').value;

  var articleName = document.getElementById('articleName').value;
  var utilities = parseFloat(document.getElementById('utilities').value);
  var salesIncome = parseFloat(document.getElementById('salesIncome').value);
  var totalSalesIncome = parseFloat(document.getElementById('totalSalesIncome').value);
  var variableCost = parseFloat(document.getElementById('variableCost').value);

  data.push({Gestion: Gestion, Mes: Mes, articleName: articleName, utilities: utilities, salesIncome: salesIncome, totalSalesIncome: totalSalesIncome, variableCost: variableCost});

  addData();

  // Calcular la rentabilidad de ventas, el índice de comerciabilidad y la contribución utilitaria
  var salesProfitability = utilities / salesIncome;
  var tradeIndex = salesIncome / totalSalesIncome;
  var utilityContribution = (salesIncome - variableCost) / salesIncome;

  // Update the hidden fields with the calculated values
  document.getElementById('profitability').value = salesProfitability;
  document.getElementById('tradeIndex').value = tradeIndex;
  document.getElementById('utilityContribution').value = utilityContribution;

  var conclusion = '';
  if(salesProfitability > 0.6 && tradeIndex > 0.6 && utilityContribution > 0.6) {
    conclusion = 'Excelente rendimiento';
  } else if(salesProfitability > 0.3 && tradeIndex > 0.3 && utilityContribution > 0.3) {
    conclusion = 'Buen rendimiento';
  } else {
    conclusion = 'Rendimiento necesita mejorar';
  }

   // Crear una nueva fila en la tabla de resultados con los datos calculados
  var row = document.createElement('tr');
  row.innerHTML = '<td>' + articleName  
  + '</td><td>' + salesProfitability.toFixed(2) 
  + '</td><td>' + tradeIndex.toFixed(2) 
  + '</td><td>' + utilityContribution.toFixed(2) 
  + '</td><td>' + conclusion
  + '</td><td><button onclick="this.parentNode.parentNode.remove()">Eliminar</button></td>';
  document.getElementById('resultsTable').appendChild(row);

});
  
function addData(){
  var dataTable = document.getElementById('data-Table');
  dataTable.innerHTML = '<tr><th>Artículo</th><th>Utilidades</th><th>Ingreso por Venta</th><th>Ingresos Totales por Venta</th><th>Costo Variable</th></tr>';
    // Reiniciar los arrays antes de agregar los nuevos datos
    for (var i = 0; i < data.length; i++) {
      // Añadir fila a la tabla de datos
      var dataRow = dataTable.insertRow(-1);
      dataRow.insertCell(0).innerHTML = data[i].articleName;
      dataRow.insertCell(1).innerHTML = data[i].utilities;
      dataRow.insertCell(2).innerHTML = data[i].salesIncome;
      dataRow.insertCell(3).innerHTML = data[i].totalSalesIncome;
      dataRow.insertCell(4).innerHTML = data[i].variableCost;
  }
}

document.getElementById('saveTable').addEventListener('click', function(e) {
  e.preventDefault();
  document.getElementById('calculatorForm').submit();
});