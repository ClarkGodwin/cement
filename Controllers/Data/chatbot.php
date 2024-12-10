<?php

include '../../Models/Database.php'; 

$cement_table = new Database('cement'); 
$standard_table = new Database('standard'); 

$cements = $cement_table->find_all(); 
$standards = $standard_table->find_all();


$quiz = [
        'bonjour' => 'Bonjour, comment allez-vous',
        'bien' => 'Ravi pour vous',
        'que fait ce site' => "C'est un site de vente en ligne de ciment",
        'au revoir' => 'A bientot'
]; 

foreach($cements as $cement){
        foreach($standards as $standard){
                if($cement['id'] == $standard['cement_id']){
                        $key = $standard['name'];
                        $value = 'Le ciment '. strtoupper($cement['name']) . ' de type '. $standard['name']. ' coute ' . $standard['unit_price']. 'BIF et il en reste '. $standard['quantity']. ' sacs'; 
                        $quiz[$key] = $value;  
                        $key = $cement['name']. ' de type '. $standard['name'];
                        $quiz[$key] = $value;  
                        $key = 'combien coute le ciment '. $cement['name']. ' de type '. $standard['unit_price']; 
                        $quiz[$key] = $value;  

                }
                else{
                        $key = $cement['name']; 
                        $value = 'Le ciment '. strtoupper($cement['name']) . ' coute ' . $cement['unit_price']. 'BIF et il en reste '. $cement['quantity']. ' sacs'; 
                        $quiz[$key] = $value;  
                        $key = 'combien coute le ciment '. $cement['name']; 
                        $quiz[$key] = $value;  
                        break; 
                }
        }
}

$cement_with_types = $standard_table->get_column('cement_id'); 

foreach($cement_with_types as $c){
        $types_names = $standard_table->get_cells_with_column('name', 'cement_id', $c); 
        $cement_name = $cement_table->get_cell('name', $c); 
        $value = "Precisez lequel, il y'en a ". count($types_names). ' standards: '; 

        for($i=0; $i < count($types_names); $i++){
                if($i == 0){
                        $value .= $types_names[$i]; 
                }
                else{
                        $value .= ", $types_names[$i]"; 
                }
        }
        $quiz[$cement_name] = $value;  
        $key = "combien coute le ciment $cement_name"; 
        $quiz[$key] = $value;  
}

function clean($data){
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        $data = strip_tags($data);
        return $data; 
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = file_get_contents('php://input'); 
        $data = json_decode($json, true); 
        $message = clean($data['message']); 
        $message = strtolower($message); 
        $response = 'Je n\'ai pas bien compris, pourriez-vous reformuler la question ou juste ecrire le nom d\'un des ciments sur le site';

        foreach($quiz as $question => $answer){
                if(strtolower($question) == strtolower($message)){
                        $response = $answer; 
                }
        }

        echo $response; 
}

?>
