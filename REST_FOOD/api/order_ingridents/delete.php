<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  header('Access-Control-Allow-Methods:DELETE');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Order_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  //Instantiate Order_ingrident object
  $Order_ingrident = new Order_ingrident($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //set id to DELETE
  $Order_ingrident->or_id = $data->or_id;
  $Order_ingrident->ingrident_id = $data->ingrident_id;
  //Create Order_ingrident
  if($Order_ingrident->delete()) {
      echo json_encode(
          array('message' => 'Order_ingrident deleted')
      );

  }else {
    echo json_encode(
        array('message' => 'Order_ingrident Not deleted')
    );
  }
  ?>