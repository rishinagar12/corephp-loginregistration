<?php  
    include_once('../model/dbFunction.php');  
    include_once('../lib/fileUpload.php');  
    $valErr  ='';
    $funObj = new dbFunction();   
    if($_POST['register']){  
        $name = $_POST['name'];  
        $emailid = $_POST['email'];  
        $password = $_POST['password']; 
        if(empty($name)){ 
            $valErr .= 'Please enter your name.<br/>'; 
        } 
        if(empty($emailid) || !filter_var($emailid, FILTER_VALIDATE_EMAIL)){ 
            $valErr .= 'Please enter a valid email.<br/>'; 
        } 
        if(empty($password)){ 
            $valErr .= 'Please enter your password.<br/>'; 
        } 
        if(empty($_FILES['file']['name'])){ 
            $valErr .= 'Please upload file.<br/>'; 
        } 
        if(empty($valErr)){ 
            $email = $funObj->isUserExist($emailid);
            
            if (!$email) {
                // file validation
                $allowedTypes = [
                    'image/png' => 'png',
                    'image/jpeg' => 'jpg'
                 ];
                $filepath = $_FILES['file']['tmp_name'];
                $fileSize = filesize($filepath);
                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                $filetype = finfo_file($fileinfo, $filepath);
                if ($fileSize === 0) {
                    $imgErroMsg .= "The file is empty.";
                 }

                 if(!in_array($filetype, array_keys($allowedTypes))) {
                    $imgErroMsg .= "File type ".$filetype." not allowed.";
                 }
                 if (empty($imgErroMsg)) {
                    $path = 'upload/profile-pic';
                    $fileName = $path.'/'.$_FILES['file']['name'];
                    $fileUpload = new fileUpload($_FILES['file'],'../'.$path);

                    // Insert data into the database 
                        $userData = ["name"=> $name,
                                "email"=> $emailid,
                                "password"=> md5($password),
                                "image"=> $fileName
                            ]; 
                    $insert = $funObj->insert('users', $userData); 
                    
                    if($insert){ 
                        $status = 'success'; 
                        $statusMsg = 'User data has been added successfully!'; 
                    }else{ 
                        unlink('../'.$fileName);
                        $status = 'error'; 
                        $statusMsg = 'Something went wrong, please try again after some time.'; 
                    } 
                 } else {
                    $status = 'error'; 
                    $statusMsg = '<p>File error </p>'.trim($imgErroMsg, '<br/>');
                 }
            } else {
                $status = 'error'; 
                $statusMsg = "Email Already Exist";
            }
        }else{ 
            $status = 'error'; 
            $statusMsg = '<p>Please fill all the mandatory fields:</p>'.trim($valErr, '<br/>'); 
        }  
        $sessData['status']['type'] = $status; 
        $sessData['status']['msg'] = $statusMsg; 
        $_SESSION['sessData'] = $sessData; 

        header("Location: ../view/index.php"); 
    }  
?>  