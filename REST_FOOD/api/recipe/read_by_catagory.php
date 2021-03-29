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

  //Get Category Id
  $recipe->category_id = isset($_GET['id']) ? $_GET['id'] : die("faild");

  //recipe query
  $result = $recipe -> read_category();
  
  //Get row count
  $num = $result -> rowCount();

  //check if any recipe
  if($num>0) {
     $recipe_arr = array();
     $recipe_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $recipe_item = array(
            'id' => $id,
            'title' => $title,
            'photo_url' => $photo_url,
            'time'=>$time,
            'description'=>$description,
            'category_id'=>$category_id,
            'fasting'=>$fasting,
            'price'=>$price,
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