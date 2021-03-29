<?php 
   class Recipe_ingrident {
       private $conn;
       private $table = 'recipe_ingrident';

       //id , name , photo_url
       public $id;
       public $recipe_id;
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
        $this->recipe_id = $row['recipe_id'];
        $this->ingrident_id = $row['ingrident_id'];
       }

       //create order ingrident
       public function create() {
        // create query
        $query = 'INSERT INTO '.$this->table. '(recipe_id,ingrident_id) VALUES (:recipe_id,:ingrident_id)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
       // $this->id = htmlspecialchars(strip_tags($this->id));
        $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));
        $this->ingrident_id = htmlspecialchars(strip_tags($this->ingrident_id));


        //Bind data
       // $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':recipe_id', $this->recipe_id);
        $stmt->bindParam(':ingrident_id', $this->ingrident_id);
       
        // Execute query
        if($stmt -> execute()){
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;
       }

       
     

       //create update
       public function update() {
        // create query
        $query = 'UPDATE '.$this->table.' SET recipe_id=:recipe_id,ingrident_id=:ingrident_id WHERE recipe_ingrident.id=:id';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));
        $this->ingrident_id = htmlspecialchars(strip_tags($this->ingrident_id));
       
        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':recipe_id', $this->recipe_id);
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