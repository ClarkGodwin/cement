<?php

include ("../../../../Models/Database.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$json = file_get_contents('php://input'); 
	$data = json_decode($json, true); 

	if($data['table_name'] == 'cement'){
		$DB = new Database($data['table_name']);
	}
}
