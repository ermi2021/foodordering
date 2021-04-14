<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:PUT');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Order_recipes.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $recipe = new Order_recipes($db);

  
  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $recipe->order_status = $data->order_status;

 
  if($recipe->updateOrderStatus()) {
        echo json_encode(
            array('message' => 'Recipe Updated')
        );
  }else {
        echo json_encode(
            array('message' => 'Recipe Not Updated')
        );
  }