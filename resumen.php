<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Sistema Contable PD</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
   <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  
  <script>
  $(document).ready(function() {
    $('select').material_select();
  });
  </script>
  
 
  
</head>
<body>
<?php    
include('html/barra.html');
include('conexion.php');   
?>

<h5 class="header center orange-text">Resumen de Información</h5>
<hr align="center" width="80%" style="color: #29b6f6;">
<br/>


<?php

$saldoinicial=1000;

$queryingresos = "SELECT SUM(Importe)FROM registros WHERE Operacion = 'Ingreso'";
$queryegresos = "SELECT SUM(Importe) FROM registros WHERE Operacion = 'Egreso'";
$querysaldo = "SELECT (SELECT SUM(Importe)FROM registros WHERE Operacion = 'Ingreso')-(SELECT SUM(Importe) FROM registros WHERE Operacion = 'Egreso');";

$db = new conectar();
$resultingresos = mysqli_query($db,$queryingresos);
$resultegresos = mysqli_query($db,$queryegresos);
$resultsaldo = mysqli_query($db,$querysaldo);


echo "<table class='striped centered'>";
    echo "<thead>";
          echo "<tr>";
              echo "<th data-field='descripcion'>Descripcion</th>";
              echo "<th data-field='importe'>Importe Total</th>";
              
              echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
              echo "<tr>";  
              echo "<td>Saldo Inicial</td>";
              echo "<td>$saldoinicial</td>";
              echo "</tr>";
              echo "<tr>";  
              echo "<td>Ingresos</td>";
              while($row=mysqli_fetch_array($resultingresos)){
              echo "<td>$row[0]</td>";
              echo "</tr>";
              }
              echo "<tr>";  
              echo "<td>Egresos</td>";
              while($rows=mysqli_fetch_array($resultegresos)){
              echo "<td>$rows[0]</td>";
              echo "</tr>";
              }
?>              
              <tr bgcolor='#FFCC99'>;  
<?php    
              echo "<td>Total</td>";
              while($row=mysqli_fetch_array($resultsaldo)){
              $saldofinal = $saldoinicial + $row[0];    
              echo "<td>$saldofinal</td>";
              echo "</tr>";
              }
    echo "</tbody>";
echo "</table>";
echo "<br>";



    
?>    
<center><a href="consulta.php" id="download-button" class="btn waves-effect waves-light light-blue lighten-1">Volver</a></center>
 </body>
</html>   