<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Order_table.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate order object
  $order = new Order_table($db);

  //order query
  $result = $order -> read();

  //Get row count
  $num = $result -> rowCount();

  //check if any order
  if($num > 0) {
     $order_arr = array();
     $order_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $order_item = array(
            'id' => $id,
            'table_no' => $table_no,
            'order_time' => $Order_time,
            'recipe_id'=>$recipe_id,
            'quantity'=>$quantity,
            
         );


         //push to 'data'
         array_push($order_arr['data'],$order_item);     
     }

     //Turn to JSON & output
     echo json_encode($order_arr);

  }
  else {
         
    // No order
    echo json_encode(
        array('message' => 'No order Found')
    );

  }

  ?>