<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$category = new Category($db);
 
// query categorys
$stmt = $category->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num >= 0){
 
    // products array
    $categories_arr=array();
    $categories_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $category_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description)
        );
 
        array_push($categories_arr["records"], $category_item);
    }
 
    http_response_code(200);
    echo json_encode(array("response" => $categories_arr, "error" => false), JSON_PRETTY_PRINT);
}
 
else{
    http_response_code(404);
    echo json_encode(
        array("response" => "No categories found.", "error" => true), JSON_PRETTY_PRINT);
}
?>