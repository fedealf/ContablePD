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
  
   <!--  Script -->
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
 
$iddiocesis= $_GET['id'];
$nomdiocesis= $_GET['nom'];
$paidiocesis= $_GET['pai'];
$parrdiocesis= $_GET['parr'];
$licdiocesis= $_GET['lic'];

        
?>
  
<h5 class="header center orange-text">Editar Diócesis</h5>
<hr align="center" width="80%" style="color: #29b6f6;">
<br/>

<div class="container">
 
  <div class="row">
    <form action="" method="post" class="col s12">
        
     <div class="row">
        <div class="center input-field col s12">
          <input value="<?php echo $nomdiocesis ?>" id="descripciondiocesis" type="text" class="validate" name='nombre'>
          <label class="active" for="descripciondiocesis">Nombre de la Diócesis</label>
        </div>
   </div>   
 

        
        
    <div class="row">
    <div class="center input-field col s6">
    <select name='pais'>
    <!-- <option value="<?php /* echo $paidiocesis ?>"><?php echo $paidiocesis */?></option> -->
    <option disabled selected>Elije tu opción</option>
<?php
include('conexion.php');


$db = new conectar();
$pais = $db ->query ("SELECT * FROM paises ORDER BY nombre ASC");


while($rows=$db->recorrer($pais)){

?> 
<option value="<?php echo $rows['idpais'] ?>"><?php echo $rows['nombre']; ?></option>    
   <?php
    }    
    ?>        
    </select>
        <label for="tipoconcepto">País de la Diócesis</label>
        </div>    
        
    <div class="left input-field col s3">
        <input value="<?php echo $parrdiocesis ?>" id="descripciondiocesis" type="text" class="validate" name='parroquias'>
          <label class="active" for="descripciondiocesis">Cantidad de Parroquias</label>
    </div>
        
   <div class="left input-field col s3">
           <input value="<?php echo $licdiocesis ?>" id="descripciondiocesis" type="text" class="validate" name='licencia'>
           <label class="active" for="descripciondiocesis">Licencia por Parroquia</label>
  </div>  
        
        
   </div>
        

        
    <div class="row">
	<div class="center input-field col s12">
        <button class="btn waves-effect waves-light orange" type="submit" name="guardar">Guardar</button>
        <a href="gestion_diocesis.php" id="cancelar-button" class="btn waves-effect waves-light light-blue lighten-1">Volver</a>
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

  
 if(isset($_POST["guardar"])){
    
  
    if ((!empty($_POST['nombre'])) && (!empty($_POST['pais'])) && (!empty($_POST['parroquias'])) && (!empty($_POST['licencia']))) {
    
        
    $nombre= $_POST['nombre'];
    $pais= $_POST['pais'];
    $parroquias= $_POST['parroquias'];
    $licencia= $_POST['licencia']; 
    
    

   
        
 $db = new conectar();
 $query = "UPDATE diocesis SET Nombre='$nombre', idpais='$pais', Parroquias='$parroquias', Costo='$licencia'  Where Id='$iddiocesis';";
 $q= mysqli_query($db, $query);
 echo "<h5 class='header center green-text'>¡El cambio ha sido guardado con éxito!</h5>" . "<br>";
 
 
 
 
    
    
 
       
}else{
    echo "<h5 class='header center red-text'>¡Debe completar todos los campos!</h5>" . "<br>";
} 
    
} 
  
  
 
?>  
  
  </body>
  
 
  
  
  
</html>