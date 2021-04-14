<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Order_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $order_ingrident = new Order_ingrident($db);
  
  //Get ID
  $order_ingrident->id = isset($_GET['id']) ? $_GET['id'] : die("faild");

  //Get Category

    $order_ingrident->read_single();

    //Create array
    $category_arr = array(
        'id' => $order_ingrident->id,
        'order_id' => $order_ingrident->order_id,
        'ingrident_id' => $order_ingrident->ingrident_id
    );

    //make JSON
    echo json_encode($category_arr);
    ?>