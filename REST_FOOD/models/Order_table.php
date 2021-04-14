<?php 
   class Order_table {
       private $conn;
       private $table = 'order_table';
      
       //id , name , photo_url
       public $id;
       public $table_no;
       public $order_time;
       public $total_price;
       public $is_orderd;
       public $recipe_id;
       public $quantity;
       public $ingridents;
       public $price;

       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //Get Category
       public function read() {
           //create query
           $query = 'SELECT id,table_no,order_time,total_price,is_orderd FROM '.$this->table.'';
           // prepare statement
           $stmt = $this->conn->prepare($query);
           // Execute query
           $stmt->execute();

           return $stmt;
       }

       public function read_single() {
        //create query
        $query = 'SELECT id,table_no,order_time,total_price,is_orderd  FROM
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
        $this->Order_time = $row['order_time'];
        $this->recipe_id = $row['total_price'];
        $this->quantity = $row['is_orderd'];
    }


    //create category
    public function create() {
       
      
        //create order table
        $query = 'INSERT INTO ' .$this->table. ' VALUES ()';

    //     //add recipe
    //     $rec_query = 'INSERT INTO '.$this->rec_table.' VALUES (NULL, last_insert_id(),:recipe_id,:quantity,:price,NULL)';

    //     //add ingrident
    //    // $ing_query = 'INSERT INTO order_ingrident VALUES (NULL, LAST_INSERTED_ID(),:ingridents)';

        //prepare statemnt
         $stmt = $this->conn->prepare($query);
    //     $rec_stmt = $this->conn->prepare($rec_query);
    //    // $ing_stmt = $this->conn->prepare($ing_query);
   
    //     //Clean data
    //     $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));
    //     $this->quantity = htmlspecialchars(strip_tags($this->quantity));
    //     $this->price=htmlspecialchars(strip_tags($this->price));
    //   //  $this->ingridents = htmlspecialchars(strip_tags($this->$ingrident_id));

    //     //Bind data
    //     $stmt->bindParam(':recipe_id', $this->recipe_id);
    //     $stmt->bindParam(':quantity', $this->quantity);
    //     $stmt->bindParam(':price', $this->price);
       
        //Execute query
        if($stmt -> execute()){
            return true;
        }
     
        //print error if something goes wrong
        printf("Error in order table %s.\n", $stmt->error);


        return false;
    }


    //update total price
    public function updateTotalPrice() {
        //query
        $query = 'UPDATE `order_table` SET total_price=(SELECT SUM(price*quantity) AS total_price from `order_recipes`) WHERE id=(select MAX(last_insert_id(id)) from `order_table`)';

        //prepare statment
        $stmt = $this->conn->prepare($query);

        //Execute query
        if($stmt -> execute()){
            echo "updated";
            return true;
        }
     
        //print error if something goes wrong
        printf("Error in order table %s.\n", $stmt->error);
        return false;
    }


    //update Category
    public function updateTableNo() {

        //Create query
        $query = 'UPDATE '.$this->table.' SET table_no=:table_no,is_orderd=1 WHERE order_table.id=last_insert_id(id)';

        //Prepare statemnt
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->table_no = htmlspecialchars(strip_tags($this->table_no));
      
        //Bind data
        $stmt->bindParam(':table_no', $this->table_no);
       
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
        $query = "DELETE FROM " .$this->table. " WHERE id=last_insert_id(id)";
 
        //prepare statement
        $stmt = $this->conn->prepare($query);

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