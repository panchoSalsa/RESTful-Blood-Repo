<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
global $_DELETE;
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/category.php';
 

// $method = $_SERVER['REQUEST_METHOD'];
// if ($method != 'DELETE') {
// 	http_response_code(404);
//     echo json_encode(
//         array("response" => "Must use HTTP DELETE method.", "error" => true), JSON_PRETTY_PRINT);
// 	exit();
// }

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare category object
$category = new Category($db);

// retrieve and set category id to be deleted
$category->id = isset($_POST['id']) ? $_POST['id'] : die();

//$category->id = isset($_DELETE['id']) ? $_DELETE['id'] : die();


// delete the category
if($category->delete()){
	http_response_code(200);
    echo json_encode(
        array("response" => "Category was deleted.", "error" => false), JSON_PRETTY_PRINT);
}
 
// if unable to delete the category
else{
	http_response_code(404);
    echo json_encode(
        array("response" => "Unable to delete object.", "error" => true), JSON_PRETTY_PRINT);
}
?>