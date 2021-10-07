<?php

//header
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header("Access-Control-Allow-Methods: POST");
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

$student->name = $data->name;
$student->age = $data->age;
$student->gender = $data->gender;
$student->email_address = $data->email_address;

if($student->create()){
    echo json_encode(
        array("Message" =>"Student created")
    );
} else{
    echo json_encode(
        array("Message" =>"Student Not created")
    );
}

?>