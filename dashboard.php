<?php

session_start();

if (isset($_SESSION['user'])) {
    include('html/barra.html');
    include('html/dashboard.html');
    include('html/footer.html');

    
    
}else{
    session_start();
    session_destroy();
    header('location: index.php');
    
}


?>
