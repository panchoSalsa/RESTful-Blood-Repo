<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare category object
$category = new Category($db);

// retrieve and set category id to be deleted
$category->id = $_POST["id"];

// delete the category
if($category->delete()){
    echo json_encode(
        array("response" => "Category was deleted.", "error" => false), JSON_PRETTY_PRINT);
}
 
// if unable to delete the category
else{
    echo json_encode(
        array("response" => "Unable to delete object.", "error" => true), JSON_PRETTY_PRINT);
}
?>