<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:PUT');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Recipe_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $recipe_ingrident= new Recipe_ingrident($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $recipe_ingrident->recipe_id = $data->recipe_id;
  $recipe_ingrident->ingrident_id = $data->ingrident_id;

  //set id to update
  $recipe_ingrident->id = $data->id;


  //Create category
  if($recipe_ingrident->update()) {
      echo json_encode(
          array('message' => 'ingrident Updated')
      );
  }else {
    echo json_encode(
        array('message' => 'ingrident Not Updated')
    );
  }