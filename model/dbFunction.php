<?php  
require_once('../config/config.php');   
session_start();  
    class dbFunction {  
        private $dbHost     = DB_HOST; 
        private $dbUsername = DB_USER; 
        private $dbPassword = DB_PASSWORD; 
        private $dbName     = DB_DATABSE;
        function __construct() {  
            
            // connecting to database  
            try{ 
                $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword); 
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $this->db = $conn; 
            }catch(PDOException $e){ 
                die("Failed to connect with MySQL: " . $e->getMessage()); 
            }
               
        }  
        // destructor  
        function __destruct() {  
              
        }  
        public function insert($table,$data){ 
            if(!empty($data) && is_array($data)){ 
                $columnString = implode(',', array_keys($data)); 
                $valueString = ":".implode(',:', array_keys($data)); 
                $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")"; 
                $query = $this->db->prepare($sql); 
                foreach($data as $key=>$val){ 
                     $query->bindValue(':'.$key, $val); 
                } 
                $insert = $query->execute(); 
                return $insert?$this->db->lastInsertId():false; 
            }else{ 
                return false; 
            } 
        }  
        public function Login($email, $password){ 
        
         $query = $this->db->prepare("SELECT * FROM users WHERE email = :email and password = :password");
         $query->bindValue(':email', $email);
         $query->bindValue(':password', md5($password));
         $query->execute();
         $no_rows = $query->rowCount();
         $user_data = $query->fetch(PDO::FETCH_ASSOC); 
            if ($no_rows == 1)   
            {  
           
                $_SESSION['login'] = true;  
                $_SESSION['uid'] = $user_data['id'];  
                $_SESSION['name'] = $user_data['name'];  
                $_SESSION['email'] = $user_data['email'];  
                $_SESSION['image'] = $user_data['image'];  
                return TRUE;  
            }  
            else  
            {  
                return FALSE;  
            }  
        }  
        public function isUserExist($emailid){  
            $qr = $this->db->prepare("SELECT * FROM users WHERE email = '".$emailid."'");  
            $row = $qr->rowCount();;  
            if($row > 0){  
                return true;  
            } else {  
                return false;  
            }  
        }  
    }  
?>  