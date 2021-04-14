<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once './../config/Database.php';
  include_once './../models/Recipe.php';
  

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  //instantiate db objects
  
  $recipe = new Recipe($db);
  
   //Get ID
   $recipe->id = isset($_GET['ids']) ? $_GET['ids'] : die("feaild");

   
  $result = $recipe -> readMultiple();

  $num = $result -> rowCount();

  if($num > 0) {
    $recipe_arr = array();
    $recipe_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $recipe_array = array(
            'id'=>$id,
            'title' => $title,
            'price'=>$price,
       );


        //push to 'data'
        array_push($recipe_arr['data'],$recipe_array);     
    }

    //Turn to JSON & output
    echo json_encode($recipe_arr);

 }
 else {
        
   // No Order_ingrident
   echo json_encode(
       array('message' => 'No recipe ingrident Found')
   );

 }

?>