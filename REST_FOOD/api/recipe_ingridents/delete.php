<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:DELETE');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Recipe_ingrident.php';

  
  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate Recipe_ingrident object
  $Recipe_ingrident = new Recipe_ingrident($db);


  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));


  //set id to DELETE
  $Recipe_ingrident->id = $data->id;

  if($Recipe_ingrident->delete()) {
      echo json_encode(
          array('message' => 'Recipe_ingrident deleted')
      );
  }else {
    echo json_encode(
        array('message' => 'Recipe_ingrident Not deleted')
    );
  }
  ?>