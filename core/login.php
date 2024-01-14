<?php  
    include_once('../model/dbFunction.php');  
       
    $funObj = new dbFunction();  
    if($_POST['login']){  
        $email = $_POST['email'];  
        $password = $_POST['password'];  
        $user = $funObj->Login($email, $password);
        
        if ($user) {  
            $status = "success";
            $statusMsg = "login successfull";
            $returenUrl = "../view/userDetail.php";
            // Registration Success  
           header("location:../view/userDetail.php");  
        } else {  
            $status = "success";
            $statusMsg = "Emailid / Password Not Match";
            $returenUrl = "../view/index.php";
        }  
    }  

        $sessData['status']['type'] = $status; 
        $sessData['status']['msg'] = $statusMsg; 
        $_SESSION['sessData'] = $sessData; 
?>  