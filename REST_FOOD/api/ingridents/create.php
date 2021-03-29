<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  header('Access-Control-Allow-Methods:POST');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,x-requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Ingridents.php';

  //Instantiate DB & Connect
  $database = new Database();
  $db =$database->connect();

  // Instantiate category object
  $Ingridents = new Ingridents($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

 
  $Ingridents->_name = $data->_name;
  $Ingridents->photo_url = $data->photo_url;


  //Create category
  if($Ingridents->create()) {
      echo json_encode(
          array('message' => 'Ingridents Created')
      );
  }else {
    echo json_encode(
        array('message' => 'Ingridents Not Created')
    );
  }