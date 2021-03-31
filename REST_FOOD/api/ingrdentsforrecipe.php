<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once './../config/Database.php';
  include_once './../models/ingriRecipe.php';
  

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  //instantiate db objects
  
  $ingriRecipe = new ingriRecipe($db);
  
   //Get ID
   $ingriRecipe->id = isset($_GET['ids']) ? $_GET['ids'] : die("faild");

   
  $result = $ingriRecipe -> read();

  $num = $result -> rowCount();

  if($num > 0) {
    $recipe_ingrident_arr = array();
    $recipe_ingrident_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $recipe_ingrident_item = array(
            'title' => $title,
            'ingrident_id'=>$ingrident_id,
            'name' => $_name,
            'photo_url' => $photo_url,
            'price' => $price
       );


        //push to 'data'
        array_push($recipe_ingrident_arr['data'],$recipe_ingrident_item);     
    }

    //Turn to JSON & output
    echo json_encode($recipe_ingrident_arr);

 }
 else {
        
   // No Order_ingrident
   echo json_encode(
       array('message' => 'No recipe ingrident Found')
   );

 }

?>