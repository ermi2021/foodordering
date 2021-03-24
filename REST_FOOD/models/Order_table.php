<?php 
   class Order_table {
       private $conn;
       private $table = 'order_table';

       //id , name , photo_url
       public $id;
       public $table_no;
       public $Order_time;
       public $Orderd_food;
       public $Orderd_drink;

       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //Get Category
       public function read() {
           //create query
           $query = 'SELECT id,table_no,Order_time,Orderd_food,Orderd_drink FROM '.$this->table.'';
           // prepare statement
           $stmt = $this->conn->prepare($query);
           // Execute query
           $stmt->execute();

           return $stmt;
       }
       public function read_single() {
        //create query
        $query = 'SELECT id,table_no,Order_time,Orderd_food,Orderd_drink  FROM
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
        $this->Orderd_food = $row['Orderd_food'];
        $this->Orderd_drink = $row['Orderd_drink'];
    }


    //create category
    public function create() {
        // create query
        $query = 'INSERT INTO ' .$this->table. '(table_no,Orderd_food,Orderd_drink) VALUES (:table_no,:Orderd_food,:Orderd_drink)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
      
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->table_no = htmlspecialchars(strip_tags($this->table_no));
        $this->Order_time = htmlspecialchars(strip_tags($this->Order_time));
        $this->Orderd_food = htmlspecialchars(strip_tags($this->Orderd_food));
        $this->Orderd_drink = htmlspecialchars(strip_tags($this->Orderd_drink));
        
        //Bind data
        $stmt->bindParam(':table_no', $this->table_no);
        $stmt->bindParam(':Orderd_food', $this->Orderd_food);
        $stmt->bindParam(':Orderd_drink', $this->Orderd_drink);

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
        $query = 'UPDATE '.$this->table.' SET table_no=:table_no,Orderd_food=:Order_food,Orderd_drink=:Order_drink WHERE order_table.id=:id';

        //Prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->table_no = htmlspecialchars(strip_tags($this->table_no));
        $this->Order_time = htmlspecialchars(strip_tags($this->Order_time));
        $this->Orderd_food = htmlspecialchars(strip_tags($this->Orderd_food));
        $this->Orderd_drink = htmlspecialchars(strip_tags($this->Orderd_drink));

        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':table_no', $this->table_no);
        
        $stmt->bindParam(':Order_food', $this->Orderd_food);
        $stmt->bindParam(':Order_drink', $this->Orderd_drink);

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

         // Execute query
         if($stmt -> execute()){
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);

        return false;



    }
   }


?>