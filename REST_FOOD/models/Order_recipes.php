<?php 
   class Order_recipes {
       private $conn;
       private $table = 'order_recipes';

       //id, order_id, recipe_id, quantity, price, order_status
       public $id;
       public $order_id;
       public $recipe_id;
       public $quantity;
       public $price;
       public $order_status;
       public $need;

       //constructor
       public function __construct($db) {
        $this->conn = $db; 
      }
 
      //get order recipes
      public function read() {
        //create query
        $query = 'SELECT id, order_id, recipe_id, quantity, price, order_status,need FROM '.$this->table.'';
        // prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();

        return $stmt;
    }

    //get last order recipes
    public function read_single() {
        //create query
        $query = 'SELECT id, order_id, recipe_id, quantity, price, order_status,need  FROM
        '.$this->table.' WHERE order_id=last_insert_id();';

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
        $this->recipe_id = $row['recipe_id'];
        $this->quantity = $row['quantity'];
        $this->price = $row['price'];
        $this->order_status = $row['order_status'];
        $this->need = $row['need'];
    }
    //create order recipe
    public function create() {
    
        //create order table
        $query = 'INSERT INTO '.$this->table.' VALUES (NULL,(select last_insert_id(id) from order_table),:recipe_id,:quantity,:price,NULL,:need)';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);

       //clean data
        $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->need=htmlspecialchars(strip_tags($this->need));
       
       //bind data
        $stmt->bindParam(':recipe_id', $this->recipe_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':need', $this->need);
   
        //Execute query
        if($stmt -> execute()){
            return true;
        }
            //print error if something goes wrong
            printf("Error in order recipe %s.\n", $stmt->error);
            return false;
        }

    //update order status
    public function updateOrderStatus() {
        //query
        $query = 'UPDATE '.$this->table.' SET 
                 order_status=:order_status 
                 WHERE order_recipes.id=
                 (select max(last_insert_id(id)) 
                 from order_recipes)';

        //prepare statment
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->order_status = htmlspecialchars(strip_tags($this->order_status));

        //Bind data
         $stmt->bindParam(':order_status', $this->order_status);

        //Execute query
        if($stmt -> execute()){
            return true;
        }
  
        //print error if something goes wrong
        printf("Error in order recipe %s.\n", $stmt->error);
        return false;
    }

    //Delete Order Recipe
    public function delete() {
         //create query
         $query = "DELETE FROM " .$this->table. " WHERE recipe_id=:recipe_id";
 
         //prepare statement
         $stmt = $this->conn->prepare($query);

         //clean data
         $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));

          //Bind data
          $stmt->bindParam(':recipe_id', $this->recipe_id);

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