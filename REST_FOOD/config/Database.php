<?php 
   class Database {
     //  Development Connection
    //    private $host = 'localhost';
    //    private $db_name = 'foodapplication';
    //    private $username = 'root';
    //    private $password = '';
    //    private $conn;


    //Production Connection
       private $host = 'remotemysql.com';
       private $db_name = 'lqRP5NyKHN';
       private $username = 'lqRP5NyKHN';
       private $password = 'je5zFL8DBd';
       private $conn;

       public function connect() {
           $this->conn = null;

           try {
              $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username , $this->password);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
           }catch(PDOException $e) {
               echo 'Connection failed:';
           }

           return $this->conn;
       }

   }

?>