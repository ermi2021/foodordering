<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Order_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate order_ingident object
  $order_ingident = new Order_ingrident($db);

  //Get order_ingident Id
  $order_ingident->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die("can't find order_ingident type");

  //order_ingident query
  $result = $order_ingident -> read_order();
  
  //Get row count
  $num = $result -> rowCount();

  //check if any order_ingident
  if($num>0) {
     $order_ingident_arr = array();
     $order_ingident_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $order_ingident_item = array(
            'id' => $id,
            'order_id' => $order_id,
            'ingrident_id' => $ingrident_id,
         );


         //push to 'data'
         array_push($order_ingident_arr['data'],$order_ingident_item);     
     }

     //Turn to JSON & output
     echo json_encode($order_ingident_arr);

  }
  else {
         
    // No order_ingident
    echo json_encode(
        array('message' => 'No order_ingident Found')
    );

  }

  ?>