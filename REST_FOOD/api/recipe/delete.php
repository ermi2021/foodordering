<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:DELETE');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Recipe.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate Recipe object
  $recipe = new Recipe($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //set id to DELETE
  $recipe->id = $data->id;

  if($recipe->delete()) {
      echo json_encode(
          array('message' => 'Recipe deleted')
      );
  }else {
    echo json_encode(
        array('message' => 'Recipe Not deleted')
    );
  }
  ?>