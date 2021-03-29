<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Ingridents.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate Ingridents object
  $Ingridents = new Ingridents($db);
  
  //Get ID
  $Ingridents->id = isset($_GET['id']) ? $_GET['id'] : die("faild");

  //Get Ingridents
  $Ingridents->read_single();

  //Create array
  $Ingridents_arr = array(
      'id' => $Ingridents->id,
      '_name' => $Ingridents->_name,
      'photo_url' => $Ingridents->photo_url,
     
  );

  //make JSON
  echo json_encode($Ingridents_arr);
?>