<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:PUT');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Order_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate Order_ingrident object
  $Order_ingrident = new Order_ingrident($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $Order_ingrident->order_id = $data->order_id;
  $Order_ingrident->ingrident_id = $data->ingrident_id;
 
  //set id to update
  $Order_ingrident->id = $data->id;

  //Create Order_ingrident
  if($Order_ingrident->update()) {
      echo json_encode(
          array('message' => 'Order_ingrident Updated')
      );
  }else {
    echo json_encode(
        array('message' => 'Order_ingrident Not Updated')
    );
  }