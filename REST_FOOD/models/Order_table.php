<?php 
   class Order_table {
       private $conn;
       private $table = 'order_table';

       //id , name , photo_url
       public $id;
       public $table_no;
       public $Order_time;
       public $recipe_id;
       public $quantity;

       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //Get Category
       public function read() {
           //create query
           $query = 'SELECT id,table_no,Order_time,recipe_id,quantity FROM '.$this->table.'';
           // prepare statement
           $stmt = $this->conn->prepare($query);
           // Execute query
           $stmt->execute();

           return $stmt;
       }

       public function read_single() {

        //create query
        $query = 'SELECT id,table_no,Order_time,recipe_id,quantity  FROM
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
        $this->table_no = $row['table_no'];
        $this->Order_time = $row['Order_time'];
        $this->recipe_id = $row['recipe_id'];
        $this->quantity = $row['quantity'];

    }


    //create category
    public function create() {

        //Create query
        $query = 'INSERT INTO ' .$this->table. '(table_no,recipe_id,quantity) VALUES (:table_no,:recipe_id,:quantity)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->table_no = htmlspecialchars(strip_tags($this->table_no));
        $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        
        //Bind data
        $stmt->bindParam(':table_no', $this->table_no);
        $stmt->bindParam(':recipe_id', $this->recipe_id);
        $stmt->bindParam(':quantity', $this->quantity);
       

        //Execute query
        if($stmt -> execute()){
            return true;
        }

        //print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;


    }

    //update Category
    public function update() {
        //Create query
        $query = 'UPDATE '.$this->table.' SET table_no=:table_no,recipe_id=:recipe_id,quantity=:quantity WHERE order_table.id=:id';

        //Prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->table_no = htmlspecialchars(strip_tags($this->table_no));
        $this->Order_time = htmlspecialchars(strip_tags($this->Order_time));
        $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        

        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':table_no', $this->table_no);
        $stmt->bindParam(':recipe_id', $this->recipe_id);
        $stmt->bindParam(':quantity', $this->quantity);
       

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

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;
    }
   }


?>