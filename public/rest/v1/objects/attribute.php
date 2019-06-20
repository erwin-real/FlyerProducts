<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read products
	function getOptions($prodid, $params){
		// select all query				
		$query = "SELECT DISTINCT av.id, av.attributeid, av.value, av.details, av.imagepath
		FROM attribute_values av 
			LEFT JOIN attribute_combinations ac ON av.attributeid=(select a.id from attributes a where a.productid=" .$prodid. " and a.order=" . (count($params)+1) . ")  
		WHERE ";
		
		foreach($params as $x=>$value) {
			$query .= " FIND_IN_SET('" . $value .  "',attribute_valuesids) AND ";
		}

		if (count($params) > 0) {
			$query .= " FIND_IN_SET(av.id,attribute_valuesids)";	
		} else {
			$query .= " av.attributeid=(select a.id from attributes a where a.productid=" .$prodid. " and a.order=" . (count($params)+1) . ")  ";
		}
		

	 //print_r($query);
	 //print_r($params);
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
		// read products
	function getAttributes($prodid, $params){
		// select all query				
		$query = "SELECT id as attributeid, a.name, a.order, a.id IN (0";
		
		foreach($params as $x=>$value) {
			$query .="," .$x;
		}
			
		$query .=") as isselected 
			FROM attributes a WHERE productid=" . $prodid . " ORDER BY a.order";
		


	 //print_r($query);
	 //print_r($params);
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
		// read products
	function selectedAttributes($prodid, $params){
		// select all query	

		$query = "SELECT a.id AS attributeid, av.id AS attribute_valuesid, a.name, av.value, av.details  
				FROM attributes a LEFT JOIN attribute_values av ON a.id=av.attributeid 
				WHERE (";
		
		foreach($params as $x=>$value) {
			$query .= " av.id=" . $value . " OR ";
		}
		$query .= " 1<>1) AND a.productid=" . $prodid . " ORDER BY a.order";
/*		$query = "SELECT DISTINCT av.id, av.value, av.details
		FROM attribute_values av 
			LEFT JOIN attribute_combinations ac ON av.attributeid=(select a.id from attributes a where a.productid=" .$prodid. " and a.order=" . (count($params)+1) . ")  
		WHERE ";
		
		foreach($params as $x=>$value) {
			$query .= " FIND_IN_SET('" . $value .  "',attribute_valuesids) AND ";
		}

		$query .= " FIND_IN_SET(av.id,attribute_valuesids)";*/

	 //print_r($query);
	 //print_r($params);
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// used when filling up the update product form
	/*function readOne($pid){

		// query to read single record
		$query = "
		
		SELECT
					c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
				FROM
					" . $this->table_name . " p
					LEFT JOIN
						categories c
							ON p.category_id = c.id
				WHERE
					p.id = " . $pid . " 
				LIMIT
					0,1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of product to be updated
		//$stmt->bindParam(1, $this->id);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		$this->name = $row['name'];
		$this->price = $row['price'];
		$this->description = $row['description'];
		$this->category_id = $row['category_id'];
		$this->category_name = $row['category_name'];
	}*/
}