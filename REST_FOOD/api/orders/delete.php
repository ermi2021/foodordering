<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:DELETE');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Order_table.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  //Instantiate order object
  $order = new Order_table($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //set id to DELETE
  $order->id = $data->id;

  if($order->delete()) {
      echo json_encode(
          array('message' => 'order deleted')
      );
  }else {
    echo json_encode(
        array('message' => 'order Not deleted')
    );
  }
  ?>