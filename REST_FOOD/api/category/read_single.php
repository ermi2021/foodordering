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
  
  //Get ID
  $category->id = isset($_GET['id']) ? $_GET['id'] : die("faild");

//   Get Category

$category->read_single();

//Create array
$category_arr = array(
    'id' => $category->id,
    'Category_name' => $category->Category_name,
    'photo_url' => $category->photo_url
);

//make JSON
echo json_encode($category_arr);
?>