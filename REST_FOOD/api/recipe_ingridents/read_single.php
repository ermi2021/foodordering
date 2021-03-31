<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Recipe_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate Recipe_ingridentobject
  $Recipe_ingrident= new Recipe_ingrident($db);
  
  //Get ID
  $Recipe_ingrident->id = isset($_GET['id']) ? $_GET['id'] : die("faild");

  //Get Recipe
  $Recipe_ingrident->read_single();

  //Create array
  $Recipe_ingrident_arr = array(
      'id' => $Recipe_ingrident->id,
      'recipe_id' => $Recipe_ingrident->recipe_id,
      'ingrident_id' => $Recipe_ingrident->ingrident_id,
    );

  //make JSON
  echo json_encode($Recipe_ingrident_arr);
  
  ?>