<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Order_recipes.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate order recipe object
  $order_recipe = new Order_recipes($db);

  
  //recipe query
  $result = $order_recipe -> read();

  //Get row count
  $num = $result -> rowCount();

  //check if any recipe
  if($num > 0) {
    $recipe_arr = array();
    $recipe_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
        $recipe_item = array(
            'id' => $id,
            'order_id' => $order_id,
            'recipe_id' => $recipe_id,
            'quantity'=>$quantity,
            'price'=>$price,
            'order_status'=>$order_status,
            'need'=>$need,
         );

         //push to 'data'
         array_push($recipe_arr['data'],$recipe_item);  
        }

        //Turn to JSON & output
        echo json_encode($recipe_arr);
   
     }
     else {
            
       // No recipe
       echo json_encode(
           array('message' => 'No ordered recipe Found')
       );
   
     }
?>