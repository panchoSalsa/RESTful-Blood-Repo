<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare category object
$category = new Category($db);
 
// get id of category to be edited
// set ID property of category to be edited
$category->id = isset($_POST['id']) ? $_POST['id'] : die();

// set category property values
$category->name = isset($_POST['name']) ? $_POST['name'] : die();
$category->description = isset($_POST['description']) ? $_POST['description'] : die();
 
// update the category
if($category->update()){
	http_response_code(200);
    echo json_encode(
        array("response" => "Category was updated.", "error" => false), JSON_PRETTY_PRINT);
}
 
// if unable to update the category, tell the user
else{
	http_response_code(404);
    echo json_encode(
        array("response" => "Unable to update Category.", "error" => true), JSON_PRETTY_PRINT);
}
?>