<?php
//include('html/index.html');
require ('conexion.php');

$modo = isset($_GET['modo']) ? $_GET['modo'] : 'default';

switch ($modo){
    
    case 'login':
        
        if (isset($_POST['login'])){
            
            if (!empty($_POST['user']) and !empty($_POST['pass'])){
                
                include ('acceso.php');
                $login = new Acceso($_POST['user'],$_POST['pass']);
                $login ->Login ();
                
                
            }  else {
               header ('location: index.php');
                
                
            }
            
        } else{
            header ('location: index.php');

        }
        
        
    break;
        
    case 'registro':
        echo "registro";
    break;
    
    case 'claveperdida':
        echo "clave perdida";
    break;
    default :
       include('html/index.html');
        
            
            
        }
        


?>