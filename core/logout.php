<?php   
    include_once('../model/dbFunction.php');  
    if($_POST['welcome']){  
        // remove all session variables  
        session_unset();   
  
        // destroy the session   
        session_destroy();  
    }  
    if(!($_SESSION)){  
        header("Location:../view/index.php");  
    }  
?> 