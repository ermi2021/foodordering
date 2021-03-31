<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:PUT');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Recipe.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $recipe = new Recipe($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $recipe->title = $data->title;
  $recipe->photo_url = $data->photo_url;
  $recipe->time = $data->time;
  $recipe->description = $data->description;
  $recipe->category_id = $data->category_id;
  $recipe->fasting = $data->fasting; 
  $recipe->price = $data->price; 
  //set id to update
  $recipe->id = $data->id;


  //Create category
  if($recipe->update()) {
      echo json_encode(
          array('message' => 'Recipe Updated')
      );
  }else {
    echo json_encode(
        array('message' => 'Recipe Not Updated')
    );
  }