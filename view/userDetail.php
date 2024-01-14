<?php
session_start(); 
 
// Get data from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
// Get status from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $status = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
?>
<!DOCTYPE html>  
 <html lang="en" class="no-js">  
 <head>  
        <meta charset="UTF-8" />  
        <title>Login and Registration Form with HTML5 and CSS3</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />  
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />  
        <meta name="author" content="Codrops" />  
        <link rel="shortcut icon" href="../favicon.ico">   
        <link rel="stylesheet" type="text/css" href="css/demo.css" />  
        <link rel="stylesheet" type="text/css" href="css/style2.css" />  
        <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />  
    </head>  
    <body>  
        <div class="container">  
            <header>  
                <h1>Welcome Form  </h1>  
            </header>  
            <section>               
                <div id="container_demo" >  
                     
                    <div id="wrapper">  
                        <div id="login" class="animate form">  
                                    <?php
                                    // Retrieve status message from session 
                                        if(!empty($sessData['status']['msg'])){ 
                                            echo '<p>'.$sessData['status']['msg'].'</p>'; 
                                            unset($sessData['status']['msg']); 
                                        } 
                                    ?>
                           <form name="logout" method="post" action="../core/logout.php">  
                                <h1>Welcome </h1>   
                                <p>   
                                    <label for="emailid" class="uname"   > Your Name </label>  
                                   <?=$_SESSION['name']?>  
                  
                                </p>  
                                <p>   
                                    <label for="email" class="youpasswd"  > Your Email </label>  
                                    <?=$_SESSION['email']?>  
                                </p>  
                                <p>   
                                    <label for="image" class="image"  > Your Email </label>  
                                    <img src="../<?=$_SESSION['image']?>" alt="search engine image" style="width: 191px;" >
                                      
                                </p>
                                <p class="login button">   
                                    <input type="submit" name="welcome" value="Logout" />   
                                </p>  
                                   
                            </form>  
                        </div>  
                    </div>  
                </div>    
            </section>  
        </div>  
    </body>  
</html>  