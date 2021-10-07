<?php

//header
header("Access-Control-Allow-Origin");
header("Content-Type: application/json");


require_once '../config/Database.php';
require_once '../models/Student.php';

//Instantiate Database & Connect
$database = new Database();
$db = $database->connect();

//  Instantiate Read Object
$student = new Student($db);

// GET id
$student->id = isset($_GET['id']) ? $_GET['id'] : die();

// Call the read_single() method
$student->read_single();

// create an array
$student_arr = array(
    "id" =>  $student->id,
    "name" => $student->name,
    "age" =>$student->age,
    "gender" => $student->gender,
    "email_address" => $student->email_address
);

// Make JSON
print_r(json_encode($student_arr));


?>