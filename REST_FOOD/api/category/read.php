<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $category = new Category($db);

  //Category query
  $result = $category -> read();

  //Get row count
  $num = $result -> rowCount();

  //check if any category
  if($num > 0) {
     $category_arr = array();
     $category_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $category_item = array(
             'id' => $id,
             'Category_name'=>$Category_name,
             'photo_url' => $photo_url

         );


         //push to 'data'
         array_push($category_arr['data'],$category_item);     
     }

     //Turn to JSON & output
     echo json_encode($category_arr);

  }
  else {
         
    // No Category
    echo json_encode(
        array('message' => 'No Category Found')
    );

  }

  ?>