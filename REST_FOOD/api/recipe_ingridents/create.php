<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:POST');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Recipe_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $Recipe_ingrident = new Recipe_ingrident($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

 
  $Recipe_ingrident->recipe_id = $data->recipe_id;
  $Recipe_ingrident->ingrident_id = $data->ingrident_id;


  //Create category
  if($Recipe_ingrident->create()) {
      echo json_encode(
          array('message' => 'Recipe_ingrident Created')
      );
  }else {
    echo json_encode(
        array('message' => 'Recipe_ingrident Not Created')
    );
  }