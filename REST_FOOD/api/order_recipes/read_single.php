<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Order_recipes.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate recipe object
  $recipe = new Order_recipes($db);
  
  //Get ID
  $recipe->id = isset($_GET['id']) ? $_GET['id'] : die("faild");

  //Get recipe
  $recipe->read_single();

  //Create array
  $recipe_arr = array(
    'id' => $id,
    'order_id' => $order_id,
    'recipe_id' => $recipe_id,
    'quantity'=>$quantity,
    'price'=>$price,
    'order_status'=>$order_status,
    'need'=>$need
  );

  //make JSON
  echo json_encode($recipe_arr);
?>