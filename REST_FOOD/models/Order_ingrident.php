<?php 
   class Order_ingrident {
       private $conn;
       private $table = 'order_ingrident';

       //id , name , photo_url
       public $id;
       public $or_id;
       public $ingridents=array();
       public $ingrident_id;
      
     

       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //read order_ingrident
       public function read() {
        //create query
        $query = 'SELECT * FROM '.$this->table.'';
        // prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();

        return $stmt;
       }


       //read single order recipe ingrident
       public function read_single() {
        //create query
        $query = 'SELECT *  FROM
        '.$this->table.' WHERE or_id=?
        LIMIT 0,1';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt -> bindParam(1,$this->or_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
        //set properties
       
        $this->id = $row['id'];
        $this->or_id = $row['or_id'];
        $this->ingridents = $row['ingridents'];
    
       }

       //create order ingrident
       public function create() {
        if(is_array($this->ingridents)){
          foreach ($this->ingridents as $value) {
              $ingrident_id = htmlspecialchars(strip_tags($value));
              $query = 'INSERT INTO '.$this->table. '(id,or_id,ingrident_id) VALUES (NULL,(select MAX(last_insert_id(id)) from order_recipes),'.$ingrident_id.')';

              //prepare statemnt
              $stmt = $this->conn->prepare($query);
           if($stmt -> execute()){
               echo "inserted";
           }else{
            echo "not inserted";
           }
          }
       }
    }

      //delete specific order ingrident
      public function delete() {

            //create query
            $query = "DELETE FROM " .$this->table. " WHERE or_id=:id AND ingrident_id=:ingrident_id";
     
            //prepare statement
            $stmt = $this->conn->prepare($query);
    
            //clean 
            $this->or_id = htmlspecialchars(strip_tags($this->or_id));
            $this->ingrident_id = htmlspecialchars(strip_tags($this->ingrident_id));
    
            //bind id
            $stmt->bindParam(':id', $this->or_id);
            $stmt->bindParam(':ingrident_id', $this->ingrident_id);
    
            //Execute query
             if($stmt -> execute()){
                return true;
              }
    
              //print error if something goes wrong
              printf("Error %s.\n", $stmt->error);
      
              return false;
          }
    }
    ?>