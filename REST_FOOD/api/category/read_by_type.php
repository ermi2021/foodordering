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
  $category = new category($db);

  //Get Category Id
  $category->cat_type = isset($_GET['type']) ? $_GET['type'] : die("can't find category type");

  //category query
  $result = $category -> read_type();
  
  //Get row count
  $num = $result -> rowCount();

  //check if any category
  if($num>0) {
     $category_arr = array();
     $category_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $category_item = array(
            'id' => $id,
            'Category_name' => $Category_name,
            'photo_url' => $photo_url,
            'cat_type'=>$cat_type,
         );


         //push to 'data'
         array_push($category_arr['data'],$category_item);     
     }

     //Turn to JSON & output
     echo json_encode($category_arr);

  }
  else {
         
    // No category
    echo json_encode(
        array('message' => 'No category Found')
    );

  }

  ?>