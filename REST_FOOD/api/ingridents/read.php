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

  //Ingridents query
  $result = $Ingridents -> read();

  //Get row count
  $num = $result -> rowCount();

  //check if any Ingridents
  if($num > 0) {
     $Ingridents_arr = array();
     $Ingridents_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $Ingridents_item = array(
             'id' => $id,
             '_name'=>$_name,
             'photo_url' => $photo_url,
        );


         //push to 'data'
         array_push($Ingridents_arr['data'],$Ingridents_item);     
     }

     //Turn to JSON & output
     echo json_encode($Ingridents_arr);

  }
  else {
         
    // No Ingridents
    echo json_encode(
        array('message' => 'No Ingridents Found')
    );

  }

?>