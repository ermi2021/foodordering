<?php 
   class Category {
       private $conn;
       private $table = 'category';

       //id , name , photo_url
       public $id;
       public $Category_name;
       public $photo_url;
       public $cat_type;

       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //Get Category
       public function read() {
           //create query
           $query = 'SELECT id,Category_name,photo_url,cat_type FROM '.$this->table.'';
           // prepare statement
           $stmt = $this->conn->prepare($query);
           // Execute query
           $stmt->execute();

           return $stmt;
       }

       //read by cat type
       public function read_type() {
        //create query
        $query = 'SELECT *  FROM
        '.$this->table.' WHERE `cat_type`=?';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt -> bindParam(1,$this->cat_type);

        // Execute query
        $stmt->execute();
        return $stmt;
       }
       
       public function read_single() {
        //create query
        $query = 'SELECT id,Category_name,photo_url,cat_type  FROM
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
        $this->cat_type = $row['cat_type'];
    }


    //create category
    public function create() {
        // create query
        $query = 'INSERT INTO ' .$this->table. '(Category_name,photo_url,cat_type) VALUES (:category_name,:photo_url,:cat_type)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->Category_name = htmlspecialchars(strip_tags($this->Category_name));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));
        $this->cat_type = htmlspecialchars(strip_tags($this->cat_type));
     
        //Bind data
        $stmt->bindParam(':category_name', $this->Category_name);
        $stmt->bindParam(':photo_url', $this->photo_url);
        $stmt->bindParam(':cat_type', $this->cat_type);

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
        $query = 'UPDATE '.$this->table.' SET Category_name=:category_name,photo_url=:photo_url,cat_type=:cat_type WHERE category.id=:id';

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
        $stmt->bindParam(':cat_type', $this->cat_type);

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