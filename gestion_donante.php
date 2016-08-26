<?php
include('html/barra.html');
include('html/gestion_donante.html');
include('conexion.php');



if(isset($_POST["buscar"])){
    
    $buscadonante= $_POST['buscadonante'];
    
    $busca = "SELECT * FROM donantes WHERE Nombre like '%$buscadonante%'";
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
    
    $donante= $_POST['donante'];
    
    if (!empty($_POST["donante"])) {
    
 $query = "INSERT INTO donantes (Id, Nombre) VALUES('','$donante')";
 $db = new conectar();
 $q= mysqli_query($db,$query);
    echo "<h5 class='header center green-text'>¡El donante ha sido creado con éxito!</h5>" . "<br>";
    
    
 $select = "SELECT * FROM donantes";
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
    echo "<td>$row[0]></td>";  
    echo "<td>$row[1]</td>";
    echo "</tr>";  
}  

             echo "</tbody>";
           echo "</table>";
   
       
}else{
    echo "<h5 class='header center red-text'>¡Debe ingresar un nombre para el donante!</h5>" . "<br>";
} 
    
}


if(isset($_POST["elimina"])){
    
    $eliminadonante= $_POST['eliminadonante'];
    
    if (!empty($eliminadonante)){
    $elimina = "DELETE from donantes WHERE Id=$eliminadonante";
    $db = new conectar();
    $e= mysqli_query($db,$elimina);
        echo "<h5 class='header center green-text'>¡El donante se ha eliminado correctamente!</h5>";
    }else{
        echo "<h5 class='header center red-text'>¡Debe especificar el Id del donante que desea eliminar!</h5>";
}

}

?>