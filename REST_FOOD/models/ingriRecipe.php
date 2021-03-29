<?php 
   class ingriRecipe {
       private $conn;
       private $recipe = 'recipe';
       private $recipe_ingrident = 'recipe_ingrident';
       private $ingridents = 'ingridents';

       //title , ingrident_id , _name , photo_url
       public $title;
       public $ingrident_id;
       public $_name;
       public $photo_url;
       public $id;
       public $price;
       

       //constructor
       public function __construct($db) {
         $this->conn = $db; 
       }

       //read order_ingrident
       public function read() {
        //create query
        echo $this->id;
        $query = 'SELECT recipe.title,recipe_ingrident.ingrident_id,
        ingridents._name,ingridents.photo_url,recipe.price FROM '.$this->recipe.','.$this->recipe_ingrident.','.$this->ingridents. ' WHERE  recipe.id = recipe_ingrident.recipe_id AND recipe_ingrident.ingrident_id = ingridents.id And recipe_id IN('.$this->id.')';
 
$stmt = $this->conn->prepare($query);
      
       
         
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Execute query
        $stmt->execute();

         //set properties
         $this->title = $row['title'];
         $this->ingrident_id = $row['ingrident_id'];
         $this->_name = $row['_name'];
         $this->photo_url = $row['photo_url'];
         $this->price = $row['price'];
        

        return $stmt;
       }
    }