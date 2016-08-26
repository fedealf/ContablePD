<?php
include('html/barra.html');
include('html/gestion_conceptos.html');
include('conexion.php');


if(isset($_POST["buscar"])){
    
    $buscaconcepto= $_POST['buscaconcepto'];
    
    $busca = "SELECT * FROM conceptos WHERE Descripcion like '%$buscaconcepto%'";
    $db = new conectar();
    $b= mysqli_query($db,$busca);
echo "<br>";
echo "<table class='striped centered'>";
      echo "<thead>";
          echo "<tr>";
              echo "<th data-field='id'>Id</th>";
              echo "<th data-field='descripcion'>Descripción</th>";
              echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
          
    while ($row = mysqli_fetch_array($b)){   
    echo "<tr>";  
    echo "<td>$row[0]</td>";  
    echo "<td>$row[1]</td>";
    echo "</tr>";  
    
           
         }   
    echo "</tbody>";
    echo "</table>";
    echo "<br>";
        
}

if(isset($_POST["nuevo"])){
    
    $concepto= $_POST['concepto'];
    
    if (!empty($_POST["concepto"])) {
    
    $query = "INSERT INTO conceptos (Id, Descripcion) VALUES('','$concepto')";
    $db = new conectar();
    $q= mysqli_query($db,$query);
    echo "<h5 class='header center green-text'>¡El concepto ha sido creado con éxito!</h5>" . "<br>";
    
    
 $select = "SELECT * FROM conceptos";
 $qs= mysqli_query($db,$select);  
   
    echo "<table class='striped centered'>";
      echo "<thead>";
          echo "<tr>";
              echo "<th data-field='id'>Id</th>";
              echo "<th data-field='descripcion'>Descripción</th>";
              echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
          
    while ($row = mysqli_fetch_array($qs)){   
    echo "<tr>";  
    echo "<td>$row[0]</td>";  
    echo "<td>$row[1]</td>";
    echo "</tr>";  
}  

             echo "</tbody>";
           echo "</table>";
           
   
       
}else{
    echo "<h5 class='header center red-text'>¡Debe ingresar un nombre para el concepto!</h5>" . "<br>";
} 
 
}


if(isset($_POST["elimina"])){
    
    $eliminaconcepto= $_POST['eliminaconcepto'];
    
    if (!empty($eliminaconcepto)){
    $elimina = "DELETE from conceptos WHERE Id=$eliminaconcepto";
    $db = new conectar();
    $e= mysqli_query($db,$elimina);
        echo "<h5 class='header center green-text'>¡El concepto se ha eliminado correctamente!</h5>";
    }else{
        echo "<h5 class='header center red-text'>¡Debe especificar el Id del concepto que desea eliminar!</h5>";
}

}


?>
