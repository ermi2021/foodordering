<?php 
   class Recipe {
       private $conn;
       private $table = 'recipe';
       public $id;
       public $title;
       public $photo_url;
       public $time;
       public $description;
       public $category_id;
       public $fasting;
       public $price;
  
        

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

        public function readMultiple() {
            //create query
            $query = 'SELECT title,price FROM '.$this->table.' WHERE id IN('.$this->id.')';
            
            // prepare statement
            $stmt = $this->conn->prepare($query);
            
           
          

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //execute query
            $stmt->execute();
            
            //set properties
            $this->title = $row['title'];
            $this->price = $row['price'];
         
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
        $this->category_id = $row['category_id'];
        $this->fasting = $row['fasting'];
        $this->price = $row['price'];

        return $stmt;
       }

       public function read_category() {
        //create query
        $query = 'SELECT *  FROM
        '.$this->table.' WHERE `category_id`=?';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt -> bindParam(1,$this->category_id);

        // Execute query
        $stmt->execute();
        return $stmt;
       }


         //create Recipe
    public function create() {
        // create query
        $query = 'INSERT INTO '.$this->table. '(title,photo_url,time,description,category_id,fasting,price) VALUES (:title,:photo_url,:time,:description,:category_id,:fasting,:price)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));
        $this->time= htmlspecialchars(strip_tags($this->time));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->fasting= htmlspecialchars(strip_tags($this->fasting));
        $this->price= htmlspecialchars(strip_tags($this->price));
        //Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':photo_url', $this->photo_url);

        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':description', $this->description);

      
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':fasting', $this->fasting);
        $stmt->bindParam(':price', $this->price);

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
        $query = 'UPDATE '.$this->table.' SET title=:title,photo_url=:photo_url,time=:time,description=:description,category_id=:category_id,fasting=:fasting,price=:price WHERE recipe.id=:id';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->photo_url = htmlspecialchars(strip_tags($this->photo_url));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->fasting = htmlspecialchars(strip_tags($this->fasting));
        $this->price = htmlspecialchars(strip_tags($this->price));

        //Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':photo_url', $this->photo_url);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':fasting', $this->fasting);
        $stmt->bindParam(':price', $this->price);
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