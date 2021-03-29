<?php 
   class Order_ingrident {
       private $conn;
       private $table = 'order_ingrident';

       //id , name , photo_url
       public $id;
       public $order_id;
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


       //read single
       public function read_single() {
        //create query
        $query = 'SELECT *  FROM
        '.$this->table.' WHERE id=?
        LIMIT 0,1';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt -> bindParam(1,$this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
        //set properties
       
        $this->id = $row['id'];
        $this->order_id = $row['order_id'];
        $this->ingrident_id = $row['ingrident_id'];
       }

       //create order ingrident
       public function create() {
        // create query
        $query = 'INSERT INTO '.$this->table. '(id,order_id,ingrident_id) VALUES (:id,:order_id,:ingrident_id)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->ingrident_id = htmlspecialchars(strip_tags($this->ingrident_id));


        //Bind data
        $stmt->bindParam(':id', $this->title);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':ingrident_id', $this->ingrident_id);
       
        // Execute query
        if($stmt -> execute()){
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;
       }

       
       public function read_order() {

        //create query
        $query = 'SELECT *  FROM
        '.$this->table.' WHERE `order_id`=?';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt -> bindParam(1,$this->order_id);

        // Execute query
        $stmt->execute();

        return $stmt;
       }

       //create update
       public function update() {
        // create query
        $query = 'UPDATE '.$this->table.' SET order_id=:order_id,ingrident_id=:ingrident_id WHERE order_ingrident.id=:id';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->ingrident_id = htmlspecialchars(strip_tags($this->ingrident_id));
       
        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':ingrident_id', $this->ingrident_id);
      
        // Execute query
        if($stmt -> execute()){
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;
        }

        public function delete() {
            //create query
            $query = "DELETE FROM " .$this->table. " WHERE id=:id";
     
            //prepare statement
            $stmt = $this->conn->prepare($query);
    
            //clean 
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            //bind id
            $stmt->bindParam(':id', $this->id);
    
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