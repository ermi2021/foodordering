<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:DELETE');
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

  //set id to DELETE
  $category->id = $data->id;


  //Create category
  if($category->delete()) {
      echo json_encode(
          array('message' => 'Category deleted')
      );
  }else {
    echo json_encode(
        array('message' => 'Category Not deleted')
    );
  }
  ?>