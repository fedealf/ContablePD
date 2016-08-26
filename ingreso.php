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
include('conexion.php');



?>
    
    
    
<h5 class="header center orange-text">Ingreso de Información</h5>
<hr align="center" width="80%" style="color: #29b6f6;">
<br/>

<div class="container">
 
  <div class="row">
      <form action="" method="post" class="col s12">
       
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
    <div class="left input-field col s6">
    <select name='moneda'>
      <option value="" disabled selected>Elije tu opción</option>
      <option value="Peso Argentino">Peso Argentino</option>
      <option value="Dólar">Dólar</option>
      <option value="Euro">Euro</option>
    </select>
    <label for="tipoconcepto">Moneda</label>
  </div>
        
    <div class="center input-field col s6">
          <input id="descripcionconcepto" type="text" class="validate" name='importe'>
          <label for="descripcionconcepto">Importe</label>
        </div> 
        </div>   
<?php
    
$conceptos = "SELECT Descripcion FROM conceptos";
$diocesis = "SELECT Nombre FROM diocesis";
$db = new conectar();
$b= mysqli_query($db,$conceptos);
$d= mysqli_query($db,$diocesis);
    
?> 
        
<div class='row'>
<div class='left input-field col s12'>
<select name='concepto'>
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
   
        
<div class='row'>
<div class='left input-field col s12'>
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
          <input id="descripcionconcepto" type="text" class="validate" name='detalle'>
          <label for="descripcionconcepto">Detalle</label>
        </div>
   </div>
        
        
   	  <div class="row">
	  <div class="center input-field col s12">
        <button class="btn waves-effect waves-light orange" type="submit" name="guardar">Guardar</button>
        <a href="gestion_ingresos.php" id="cancelar-button" class="btn waves-effect waves-light orange">Cancelar</a>
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

  //-----------------------------------------------------------------------
 if(isset($_POST["guardar"])){
    
    
    $fecha= $_POST['fecha'];
    $operacion= $_POST['operacion'];
    $transaccion= $_POST['transaccion'];
    $moneda= $_POST['moneda'];
    $importe= $_POST['importe'];
    $conc= $_POST['concepto'];
    $dio= $_POST['diocesis'];
    $detalle= $_POST['detalle'];
    $newDate = date("Y-m-d", strtotime($fecha));
    
   
    
    
    if ((!empty($_POST['fecha'])) && (!empty($_POST['operacion'])) && (!empty($_POST['transaccion'])) && (!empty($_POST['moneda'])) && (!empty($_POST['importe'])) && (!empty($_POST['concepto'])) && (!empty($_POST['diocesis']))) {
    
 $registro = "INSERT INTO registros (Id, Fecha, Operacion, Transaccion, Moneda, Importe, Descripcion, Diocesis, Detalle) VALUES('','$newDate','$operacion','$transaccion','$moneda','$importe','$conc','$dio','$detalle')";
 $db = new conectar();
 $reg= mysqli_query($db, $registro);
 echo "<h5 class='header center green-text'>¡El registro ha sido creado con éxito!</h5>" . "<br>";
    
    
 $select = "SELECT * FROM registros";
 $qs= mysqli_query($db, $select);  
    
    echo "<table class='striped centered'>";
      echo "<thead>";
          echo "<tr>";
              echo "<th data-field='id'>Id</th>";
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
          
    while ($row = mysqli_fetch_array($qs)){   
    echo "<tr>";  
    echo "<td>$row[0]</td>";  
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
   
       
}else{
    echo "<h5 class='header center red-text'>¡Debe ingresar todos los datos del registro!</h5>" . "<br>";
} 
    
} 
  
  
  
  
  
  
?>  
  
  
  
  
  
  
  </body>
  
 
  
  
  
</html>