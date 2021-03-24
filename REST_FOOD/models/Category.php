<?php 
   class Category {
       private $conn;
       private $table = 'category';

       //id , name , photo_url
       public $id;
       public $Category_name;
       public $photo_url;

       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //Get Category
       public function read() {
           //create query
           $query = 'SELECT id,Category_name,photo_url FROM '.$this->table.'';
           // prepare statement
           $stmt = $this->conn->prepare($query);
           // Execute query
           $stmt->execute();

           return $stmt;
       }
       public function read_single() {
        //create query
        $query = 'SELECT id,Category_name,photo_url  FROM
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
        $this->Category_name = $row['Category_name'];
        $this->photo_url = $row['photo_url'];
    }


    //create category
    public function create() {
        // create query
        $query = 'INSERT INTO ' .$this->table. '(Category_name,photo_url) VALUES (:category_name,:photo_url)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->Category_name = htmlspecialchars(strip_tags($this->Category_name));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));

        //Bind data
        $stmt->bindParam(':category_name', $this->Category_name);
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
        $query = 'UPDATE '.$this->table.' SET Category_name=:category_name,photo_url=:photo_url WHERE category.id=:id';

        //Prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->Category_name = htmlspecialchars(strip_tags($this->Category_name));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));

        //Bind data
        $stmt->bindParam(':category_name', $this->Category_name);
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
        $query = "DELETE FROM " .$this->table. "WHERE id=:id";
 
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