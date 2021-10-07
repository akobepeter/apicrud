<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../config/Database.php';
require_once '../models/Student.php';

// Instantiate DB & Connect
 $database = new Database();
 $db = $database->connect();

//  Instantiate Read Object
 $student = new Student($db);

//Read student query
$result =  $student->read();

// Get row count
$num = $result->rowCount();


// check if there any student(s)
if($num>0){
  //Student array
  $students_arr = array();
  $students_arr['data'] = array();
  
  while($row = $result->fetch(PDO::FETCH_ASSOC)){
     extract($row);

     $e = array(
         'id' => $id,
         'name' => $name,
         'age' => $age,
         'gender' => $gender,
         'email_address' => $email_address,
     );

    //Push to 'data'
     array_push($students_arr['data'], $e);
  }

    // Turn it to JSON & output
       echo  json_encode($students_arr);

}else{
   
    // No Post
    echo json_encode(array('Message' =>'No Post Found'));

}

?>