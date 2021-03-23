<?php 
   class Recipe {
       private $conn;
       private $table = 'recipe';

    
       public $id;
       public $title;
       public $photo_url;
       public $time;
       public $description;
       public $ingridents;
       public $category_id;


       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //Get Recipe
       public function read() {
           //create query
           $query = 'SELECT * FROM '.$this->table.'';
           // prepare statement
           $stmt = $this->conn->prepare($query);
           // Execute query
           $stmt->execute();

           return $stmt;
        }
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
       
        $this->title = $row['title'];
        $this->photo_url = $row['photo_url'];
        $this->time = $row['time'];
        $this->description = $row['description'];
        $this->ingridents = $row['ingridents'];
        $this->category_id = $row['category_id'];
       }


         //create Recipe
    public function create() {
        // create query
        $query = 'INSERT INTO '.$this->table. '(title,photo_url,time,description,ingridents,category_id) VALUES (:title,:photo_url,:time,:description,:ingridents,:category_id)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));
        $this->time= htmlspecialchars(strip_tags($this->time));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->ingridents= htmlspecialchars(strip_tags($this->ingridents));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':photo_url', $this->photo_url);

        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':description', $this->description);

        $stmt->bindParam(':ingridents', $this->ingridents);
        $stmt->bindParam(':category_id', $this->category_id);

        // Execute query
        if($stmt -> execute()){
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;


    }

    //update Recipe
    public function update() {
        // create query
        $query = 'UPDATE '.$this->table.' SET title=:title,photo_url=:photo_url,time=:time,description=:description,ingridents=:ingridents,category_id=:category_id WHERE recipe.id=:id';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->ingridents = htmlspecialchars(strip_tags($this->ingridents));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':photo_url', $this->photo_url);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':ingridents', $this->ingridents);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if($stmt -> execute()){
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;


    }

    //delete recipe
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