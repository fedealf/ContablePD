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
//include('html/consulta.html');
include('conexion.php');   
?>
    
<?php
    
$conceptos = "SELECT Descripcion FROM conceptos";
$diocesis = "SELECT Nombre FROM diocesis";
$db = new conectar();
$b= mysqli_query($db,$conceptos);
$d= mysqli_query($db,$diocesis);
    
?>    

<h5 class="header center orange-text">Consulta de Información</h5>
<hr align="center" width="80%" style="color: #29b6f6;">
<br/>

<div class="container">
 
  <div class="row">
      <form class="col s12" action='' method="post">
       
    <div class="row">
    <div class="left input-field col s4">
    <input type="date" class="datepicker" name='fecha'>
   <label for="fecha">Fecha</label>
  </div>    
        
    <div class="left input-field col s4">
    <select name='operacion'>
      <option value="" disabled selected>Elije tu opción</option>
      <option value="Ingreso">Ingreso</option>
      <option value="Egreso">Egreso</option>
    </select>
    <label for="tipoconcepto">Tipo de Operación</label>
  </div>
        
   <div class="left input-field col s4">
    <select name='transaccion'>
      <option value="" disabled selected>Elije tu opción</option>
      <option value="Transferencia">Transferencia</option>
      <option value="Efectivo">Efectivo</option>
      <option value="Débito Automático">Débito Automático</option>
      <option value="Débito">Débito</option>
    </select>
    <label for="tipoconcepto">Tipo de Transacción</label>
  </div>  
  
   </div>
        
    <div class="row">  
    <div class="left input-field col s4">
    <select name='moneda'>
      <option value="" disabled selected>Elije tu opción</option>
      <option value="Peso Argentino">Peso Argentino</option>
      <option value="Dólar">Dólar</option>
      <option value="Euro">Euro</option>
    </select>
    <label for="tipoconcepto">Moneda</label>
  </div>
        
    <div class="center input-field col s8">
    <select name='descripcion'>
      <option disabled selected>Elije tu opción</option>
<?php
while($row=mysqli_fetch_array($b)){

?> 
<option value="<?php echo $row['Descripcion'] ?>">
<?php echo $row['Descripcion']; ?>
        </option>    
   <?php
    }    
    ?>        
    </select>
        <label for="tipoconcepto">Descripción del Concepto</label>
        </div> 
        
   </div>      
   
   <div class="row">    
    <div class="left input-field col s12">
    <select name='diocesis'>
      <option disabled selected>Elije tu opción</option>
<?php
while($row=mysqli_fetch_array($d)){

?> 
<option value="<?php echo $row['Nombre'] ?>">
<?php echo $row['Nombre']; ?>
        </option>    
   <?php
    }    
    ?>   
    </select>
    <label for="tipoconcepto">Diócesis / Donante</label>
  </div>
   </div> 
        
            
   
        
   	  <div class="row">
	  <div class="center input-field col s12">
        <button class="btn waves-effect waves-light orange" type="submit" name="buscar">Buscar</button>
        <button class="btn waves-effect waves-light orange" type="submit" name="limpiar">Limpiar</button>
        <a href="resumen.php" id="download-button" class="btn waves-effect waves-light orange">Resumen</a>
        <a href="dashboard.php" id="download-button" class="btn waves-effect waves-light light-blue lighten-1">Volver</a>
        
          </div>
	  </div>
	  
          
    </form>
	
  
  </div>
  </div>


 <script>
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
  </script>


<?php


if(isset($_POST["buscar"])){


    if(isset($_POST['fecha'])){ $fecha = $_POST['fecha']; } 
    if(isset($_POST['operacion'])){ $operacion = $_POST['operacion']; }
    if(isset($_POST['transaccion'])){ $transaccion = $_POST['transaccion']; }
    if(isset($_POST['moneda'])){ $moneda = $_POST['moneda']; } 
    if(isset($_POST['descripcion'])){ $descripcion = $_POST['descripcion']; } 
    if(isset($_POST['diocesis'])){ $diocesis = $_POST['diocesis']; } 


if(isset($_POST['fecha']) && $_POST['fecha']!="")
{
$newDate = date("Y-m-d", strtotime($fecha));
$where[] = "Fecha LIKE '$newDate'";
}
if(isset($_POST['operacion']) && $_POST['operacion']!="")
{
$where[] = "Operacion LIKE '%".$_POST['operacion']."%'";
}
if(isset($_POST['transaccion']) && $_POST['transaccion']!="")
{
$where[] = "Transaccion LIKE '%".$_POST['transaccion']."%'";
}
if(isset($_POST['moneda']) && $_POST['moneda']!="")
{
$where[] = "Moneda LIKE '%".$_POST['moneda']."%'";
}
if(isset($_POST['descripcion']) && $_POST['descripcion']!="")
{
$where[] = "Descripcion LIKE '%".$_POST['descripcion']."%'";
}
if(isset($_POST['diocesis']) && $_POST['diocesis']!="")
{
$where[] = "Diocesis LIKE '%".$_POST['diocesis']."%'";
}


$query = "SELECT * FROM registros WHERE ".implode(" AND ",$where);
$db = new conectar();
$result = mysqli_query($db,$query);



echo "<br>";
echo "<table class='striped centered'>";
      echo "<thead>";
          echo "<tr>";
              echo "<th data-field='fecha'>Fecha</th>";
              echo "<th data-field='operacion'>Operación</th>";
              echo "<th data-field='transaccion'>Transacción</th>";
              echo "<th data-field='moneda'>Moneda</th>";
              echo "<th data-field='importe'>Importe</th>";
              echo "<th data-field='descripcion'>Descripcion</th>";
              echo "<th data-field='diocesis'>Diócesis</th>";
              echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
          
    while ($row = mysqli_fetch_array($result)){   
              echo "<tr>";  
              echo "<td>$row[1]</td>";
              echo "<td>$row[2]</td>";
              echo "<td>$row[3]</td>";
              echo "<td>$row[4]</td>";
              echo "<td>$row[5]</td>";
              echo "<td>$row[6]</td>";
              echo "<td>$row[7]</td>";
              echo "</tr>";  
}   
        echo "</tbody>";
echo "</table>";
echo "<br>";

}


?>

  </body>
</html>