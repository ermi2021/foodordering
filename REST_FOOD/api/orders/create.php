<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:POST');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Order_table.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $Order = new Order_table($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

 
  $Order->table_no = $data->table_no;
  $Order->Order_time = $data->Order_time;
  $Order->recipe_id = $data->recipe_id;
  $Order->quantity = $data->quantity;
 


  //Create category
  if($Order->create()) {
      echo json_encode(
          array('message' => 'Order Created')
      );
  }else {
    echo json_encode(
        array('message' => 'Order Not Created')
    );
  }