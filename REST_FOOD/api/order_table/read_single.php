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
  
  //Get ID
  $order->id = isset($_GET['id']) ? $_GET['id'] : die("faild");

  //Get order
  $order->read_single();


  //Create array
  $order_arr = array(
      'id' => $order->id,
      'table_no' => $order->table_no,
      'Order_time' => $order->Order_time,
      'Orderd_food'=>$order->Orderd_food,
      'Orderd_drink'=>$order->Orderd_drink,
  );


  //make JSON
  echo json_encode($order_arr);
  
?>