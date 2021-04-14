<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Order_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate Order_ingrident object
  $Order_ingrident = new Order_ingrident($db);

  //Order_ingrident query
  $result = $Order_ingrident -> read();

  //Get row count
  $num = $result -> rowCount();

  //check if any Order_ingrident
  if($num > 0) {
     $Order_ingrident_arr = array();
     $Order_ingrident_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $Order_ingrident_item = array(
             'id' => $id,
             'or_id'=>$or_id,
             'ingridents' => $ingridents,
        );


         //push to 'data'
         array_push($Order_ingrident_arr['data'],$Order_ingrident_item);     
     }

     //Turn to JSON & output
     echo json_encode($Order_ingrident_arr);

  }
  else {
         
    // No Order_ingrident
    echo json_encode(
        array('message' => 'No Order_ingrident Found')
    );

  }

?>