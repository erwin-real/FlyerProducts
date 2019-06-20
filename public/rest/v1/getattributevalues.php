<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once './config/database.php';
include_once './objects/attribute.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new Product($db);
 
// set ID property of record to read
//$product->id = isset($_GET['id']) ? $_GET['id'] : die();
//$product->id = $_GET['id'] ;
//$product->id = 60; 
// read the details of product to be edited


//$product->readOne(60);
 
//if($product->name!=null){

// set ID property of record to read
//$product->id = isset($_GET['id']) ? $_GET['id'] : die();


$prodid = isset($_GET['productid']) ? $_GET['productid'] : die();
$params = array();
parse_str($_SERVER['QUERY_STRING'], $params);

unset($params["productid"]);

$products_arr=array();
$products_arr["attributes"]=array();
$products_arr["options"]=array();
$products_arr["selected"]=array();

$stmt = $product->getAttributes($prodid, $params);
$count = $stmt->rowCount();
if($count>0){
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
 
		$product_item=array(
			"attributeid" => $attributeid,
			"name" => $name,
			"order" => $order,
			"isselected" => boolval ($isselected)
		);
 
		array_push($products_arr["attributes"], $product_item);
	}
}

$stmt = $product->getOptions($prodid, $params);
$num = $stmt->rowCount();
 
// check if more than 0 record found
//if($num>0){
	
	    // products array

	
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "id" => $id,
			"attributeid" => $attributeid,
            "value" => html_entity_decode($value),
            "details" => html_entity_decode($details),
			"imagepath" => $imagepath
        );
 
        array_push($products_arr["options"], $product_item);
    }
 
	$stmt = $product->selectedAttributes($prodid, $params);
	$count = $stmt->rowCount();
	if($count>0){
		    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "attributeid" => $attributeid,
			"attribute_valuesid" => $attribute_valuesid,
			"name" => $name,
			"value" => $value,
			"details" => $details
        );
 
        array_push($products_arr["selected"], $product_item);
			}
	}
	
    // set response code - 200 OK
    http_response_code(200);
	
	/*
    $product_arr = array(
        "id" =>  $product->id,
        "name" => $product->name,
        "description" => $product->description,
        "price" => $product->price,
        "category_id" => $product->category_id,
        "category_name" => $product->category_name
 
    );
 $product_arr["records"]=array();
    // set response code - 200 OK
    http_response_code(200);
	
	array_push($product_arr["records"], $_SERVER["QUERY_STRING"]);
	//array_push($product_arr["records"], parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
	*/
 
    // make it json format
    echo json_encode($products_arr);
 
/*}else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}*/

?>