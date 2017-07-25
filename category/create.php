<?php


// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate category object
include_once '../objects/category.php';
 
$database = new Database();
$db = $database->getConnection();
 
$category = new Category($db);
 
// get posted data
//$data = json_decode(file_get_contents('php://input'), true);

// set category property values
$category->name = isset($_POST['name']) ? $_POST['name'] : die();
$category->description = isset($_POST['description']) ? $_POST['description'] : die();
$category->created = date('Y-m-d H:i:s');
$category->modified = date('Y-m-d H:i:s');


// if($_SERVER['REQUEST_METHOD'] === 'PUT') parse_str(file_get_contents('php://input'), $_PUT);
// if($_SERVER['REQUEST_METHOD'] === 'DELETE') parse_str(file_get_contents('php://input'), $_DELETE)
// $category->name = $data->['name'];
// $category->description = $data['description'];
// $category->created = date('Y-m-d H:i:s');
// $category->modified = date('Y-m-d H:i:s');
 
// create the category
if($category->create()){
	http_response_code(201);
    echo json_encode(
        array("response" => "Category was created.", "error" => false), JSON_PRETTY_PRINT);
}
 
// if unable to create the category, tell the user
else{
	http_response_code(409);
    echo json_encode(
        array("response" => "Unable to create Category.", "error" => true), JSON_PRETTY_PRINT);
}
?>