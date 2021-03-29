<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Recipe_ingrident.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate recipe object
  $recipe_ingrident = new Recipe_ingrident($db);

  //recipe query
  $recipe_ingrident = $recipe_ingrident -> read();

  //Get row count
  $num = $recipe_ingrident -> rowCount();

  //check if any recipe
  if($num > 0) {
     $recipe_arr = array();
     $recipe_arr['data'] = array();

     while($row = $recipe_ingrident->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $recipe_item = array(
            'id' => $id,
            'recipe_id' => $recipe_id,
            'ingrident_id' => $ingrident_id,
         );


         //push to 'data'
         array_push($recipe_arr['data'],$recipe_item);     
     }

     //Turn to JSON & output
     echo json_encode($recipe_arr);

  }
  else {
         
    // No recipe
    echo json_encode(
        array('message' => 'No recipe Found')
    );

  }

  ?>