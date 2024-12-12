<?php

include ("../../../../Models/Database.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$json = file_get_contents('php://input'); 
	$data = json_decode($json, true); 

	if($data['table_name'] == 'cement'){
		$DB = new Database($data['table_name']);
		$id = intval($data['id']);

		$name = ucfirst(strtolower($data['name']));

		$input_data = [
			'name'=> $name,
			'description'=> $data['description'],
			'quantity'=> intval( $data['quantity'] )
		]; 

		if(isset($data['standard']) && $data['standard'] == 'no'){
			$input_data['unit_price'] = intval($data['unit_price']);
		}

		// $DB->updates($input_data, $id);

		// echo "L'élément avec l'id $id a été modifier avec succès";
		var_dump($data['standards[]']); 
	}
}
