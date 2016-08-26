<?php
include('html/barra.html');
include('html/gestion_diocesis.html');
include('conexion.php');




if(isset($_POST["buscar"])){
    
    $buscadiocesis= $_POST['buscadiocesis'];
    $busca= "SELECT * FROM diocesis a INNER JOIN paises b ON a.idpais=b.idpais WHERE a.Nombre like '%$buscadiocesis%'";
    $db = new conectar();
    $b= mysqli_query($db,$busca);
    
    
echo "<br>";
echo "<table class='striped centered'>";
      echo "<thead>";
          echo "<tr>";
              echo "<th data-field='id'>Id</th>";
              echo "<th data-field='nombre'>Nombre</th>";
              echo "<th data-field='pais'>País</th>";
              echo "<th data-field='parroquias'>Parroquias</th>";
              echo "<th data-field='licencia'>Licencia</th>";
              echo "<th data-field='modificar'></th>";
              echo "<th data-field='eliminare'></th>";
              echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
          
    while ($row = mysqli_fetch_array($b)){   
              echo "<tr>";  
              echo "<td>$row[0]</td>";  
              echo "<td>$row[1]</td>";
              echo "<td>$row[7]</td>";
              echo "<td>$row[3]</td>";
              echo "<td>$row[4]</td>";
              echo "<td><a href=\"editar_diocesis.php?id=".$row['0']."&nom=".$row['1']."&pai=".$row['7']."&parr=".$row['3']."&lic=".$row['4']."\"><i class=\"material-icons\">settings_backup_restore</i></a></td>";
              echo "<td><a href=\"\"><i class=\"material-icons\">delete</i></a></td>";
              
              
              
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
    
    $eliminadiocesis= $_POST['eliminadiocesis'];
    
    if (!empty($eliminadiocesis)){
    $elimina = "DELETE from diocesis WHERE Id=$eliminadiocesis";
    $db = new conectar();
    $e= mysqli_query($db,$elimina);
        echo "<h5 class='header center green-text'>¡La Diócesis se ha eliminado correctamente!</h5>";
    }else{
        echo "<h5 class='header center red-text'>¡Debe especificar el Id de la Diócesis que desea eliminar!</h5>";
}

}


?>


