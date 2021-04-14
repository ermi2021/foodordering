<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:PUT');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Order_table.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $order = new Order_table($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $order->table_no = $data->table_no;

  
    //Create category
    if($order->updateTableNo()) 
    {
        echo json_encode(
        array('message' => 'order table Updated')
        );
    }
    else
    {
        echo json_encode(
        array('message' => 'order table Not Updated')
        );
    }