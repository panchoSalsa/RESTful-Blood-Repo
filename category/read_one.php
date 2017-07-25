<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare category object
$category = new Category($db);
 
// set ID property of category to be edited
$category->id = isset($_POST['id']) ? $_POST['id'] : die();

// read the details of category to be edited
$category->readOne();

// create array
$category_arr = array(
    "id" =>  $category->id,
    "name" => $category->name,
    "description" => $category->description,
);

http_response_code(200);
// make it json format
echo json_encode(array("response" => $category_arr, "error" => false), JSON_PRETTY_PRINT);
?>