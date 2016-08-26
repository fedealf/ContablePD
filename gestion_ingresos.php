<?php
include('html/barra.html');
include('html/gestion_ingresos.html');
include('conexion.php');




if(isset($_POST["buscar"])){
    
    $buscaregistro= $_POST['buscaregistro'];
    
    $busca = "SELECT * FROM registros WHERE Descripcion like '%$buscaregistro%'";
    $db = new conectar();
    $b= mysqli_query($db,$busca);
    
    
echo "<br>";
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
          
    while ($row = mysqli_fetch_array($b)){   
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
               echo "<td>$row[0]></td>";  
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
    
    $eliminaingreso= $_POST['eliminaingreso'];
    
    if (!empty($eliminaingreso)){
    $elimina = "DELETE from registros WHERE Id=$eliminaingreso";
    $db = new conectar();
    $e= mysqli_query($db,$elimina);
        echo "<h5 class='header center green-text'>¡El registro se ha eliminado correctamente!</h5>";
    }else{
        echo "<h5 class='header center red-text'>¡Debe especificar el Id del registro que desea eliminar!</h5>";
}

}


?>
