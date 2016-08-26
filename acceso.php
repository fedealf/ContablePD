<?php

class Acceso {
    
    protected $user;
    protected $pass;


    public function __construct($usuario,$password) {
        $this->user = $usuario;
        $this->pass = $password;
    }
    
    public function Login() {
        $db = new conectar();
        $sql = $db->query("SELECT Nick,Contrasena FROM usuarios WHERE Nick = '$this->user' OR Contrasena = '$this->pass';");
        $dato = $db->recorrer($sql);
     
    if ($dato['Nick'] == $this->user and $dato['Contrasena'] == $this->pass){
        session_start();
        $_SESSION['user'] = $this->user;
        header('location: dashboard.php'); 
            
        }else {
            header ('location: index.php');
            
        }
            
    }
    
    public function ClavePerdida() {
        
    }
    
}




?>