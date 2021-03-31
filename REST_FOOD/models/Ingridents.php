<?php 
   class Ingridents {
       private $conn;
       private $table = 'ingridents';

       //id , name , photo_url
       public $id;
       public $_name;
       public $photo_url;
      

       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //Get Category
       public function read() {
           //create query
           $query = 'SELECT id,_name,photo_url FROM '.$this->table.'';
           // prepare statement
           $stmt = $this->conn->prepare($query);
           // Execute query
           $stmt->execute();

           return $stmt;
       }

       //read by cat type
       public function read_name() {
        //create query
        $query = 'SELECT *  FROM
        '.$this->table.' WHERE `_name`=?';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt -> bindParam(1,$this->_name);

        // Execute query
        $stmt->execute();
        return $stmt;
       }
       
       public function read_single() {
        //create query
        $query = 'SELECT id,_name,photo_url  FROM
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
        $this->_name = $row['_name'];
        $this->photo_url = $row['photo_url'];
        
    }


    //create category
    public function create() {
        // create query
        $query = 'INSERT INTO ' .$this->table. '(_name,photo_url) VALUES (:_name,:photo_url)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->_name = htmlspecialchars(strip_tags($this->_name));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));
      
     
        //Bind data
        $stmt->bindParam(':_name', $this->_name);
        $stmt->bindParam(':photo_url', $this->photo_url);
       

        // Execute query
        if($stmt -> execute()){
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;


    }

    //update Category
    public function update() {
        //Create query
        $query = 'UPDATE '.$this->table.' SET _name=:_name,photo_url=:photo_url WHERE ingridents.id=:id';

        //Prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->_name = htmlspecialchars(strip_tags($this->_name));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));

        //Bind data
        $stmt->bindParam(':_name', $this->_name);
        $stmt->bindParam(':photo_url', $this->photo_url);
        $stmt->bindParam(':id', $this->id);
        

        // Execute query
        if($stmt -> execute()){
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;
    }

    //Delete Category
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