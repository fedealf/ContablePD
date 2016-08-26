<?php

class conectar extends mysqli {
    

    public function __construct(){
        parent::__construct('localhost','root','','contablepd');
        $this->query ("SET NAMES 'utf8';");
        $this->connect_errno ? die ('Error en la conexión') : $x = 'Conectado';
        //echo $x;
        //unset ($x);

    }
    
    public function recorrer($y) {
        return mysqli_fetch_array($y);
        
    }

}

?>