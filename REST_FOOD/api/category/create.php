<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:POST');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $category = new Category($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $category->Category_name = $data->Category_name;
  $category->photo_url = $data->photo_url;
  $category->cat_type = $data->cat_type;

  //Create category
  if($category->create()) {
      echo json_encode(
          array('message' => 'Category Created')
      );
  }else {
    echo json_encode(
        array('message' => 'Category Not Created')
    );
  }