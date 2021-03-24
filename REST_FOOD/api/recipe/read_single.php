<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Recipe.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate recipe object
  $recipe = new Recipe($db);
  
  //Get ID
  $recipe->id = isset($_GET['id']) ? $_GET['id'] : die("faild");

  //Get recipe
  $recipe->read_single();

  //Create array
  $recipe_arr = array(
      'id' => $recipe->id,
      'title' => $recipe->title,
      'photo_url' => $recipe->photo_url,
      'time'=>$recipe->time,
      'description'=>$recipe->description,
      'ingridents'=>$recipe->ingridents,
      'category_id'=>$recipe->category_id,
  );

  //make JSON
  echo json_encode($recipe_arr);
?>