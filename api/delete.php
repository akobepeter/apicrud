<?php

//header
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../config/Database.php';
require_once '../models/Student.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//  Instantiate Read Object
$student = new Student($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));


// Set ID to update
$student->id = $data->id;


//delete post 
if($student->delete()){
    echo json_encode(
        array("Message" =>"Student Deleted",
        "student" => $student)
    );
} else{
    echo json_encode(
        array("Message" =>"Student Not Deleted")
    );
}

?>