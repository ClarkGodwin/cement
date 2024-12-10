<?php

require '../../Models/Database.php'; 

function clean($data){
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        $data = strip_tags($data);
        return $data; 
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = file_get_contents('php://input'); 
        $data = json_decode($json, true); 

        $cements = new Database('cement');
        $sales = new Database('sales'); 

        $client_name = $data['last_name']. ' '. $data['first_name']; 
        $client_num = $data['num_phone']; 
        $client_address = $data['address']; 
        $nbr_bags = intval($data['nbr']); 
        $cement = $data['cement']; 

        
        if(str_contains($cement, '.')){
                $cement_id_standard_id = explode('.', $cement); 
                $cement_id = intval($cement_id_standard_id[0]); 
                $standard_id = intval($cement_id_standard_id[1]); 

                $standards = new Database('standard'); 
                $values = $standards->find($standard_id); 
                $price = $values['unit_price']; 
        
                $remaining_standard_bags = $values['quantity'] - $nbr_bags;
        
                if($remaining_standard_bags < 0){
                        echo 'Toutes nos excuses, nous n\'en avons pas assez en stock'; 
                        die;
                }
                if($nbr_bags == 0){
                        echo 'Vous devez en en acheter au moins un'; 
                        die;
                }
                $standards->update('quantity', $remaining_standard_bags, $standard_id); 

                $cement_values = $cements->find($cement_id); 
                $remaining_cement_bags = $cement_values['quantity'] - $nbr_bags;
                $cements->update('quantity', $remaining_cement_bags, $cement_id); 
                
                $total_price = $price * $nbr_bags; 
                $tables = [
                        'cement_id' => $cement_id,
                        'standard_id' => $standard_id,
                        'client_name' => $client_name,
                        'client_num' => $client_num,
                        'client_address' => $client_address,
                        'nbr_bags' => $nbr_bags,
                        'total_price' => $total_price
                ];
        
                $sales->insert($tables); 
        
                echo 'Merci pour votre achat'; 
        }
        else{
                $cement_id = intval($cement); 
                $values = $cements->find($cement_id); 
                $price = $values['unit_price']; 
        
                $remaining_bags = $values['quantity'] - $nbr_bags;
        
                if($remaining_bags < 0){
                        echo 'Toutes nos excuses, nous n\'en avons pas assez en stock'; 
                        die;
                }
                $cements->update('quantity', $remaining_bags, $cement_id); 
                
                $total_price = $price * $nbr_bags; 
                $tables = [
                        'cement_id' => $cement_id,
                        'client_name' => $client_name,
                        'client_num' => $client_num,
                        'client_address' => $client_address,
                        'nbr_bags' => $nbr_bags,
                        'total_price' => $total_price
                ];
        
                $sales->insert($tables); 
        
                echo 'Merci pour votre achat'; 
        }


}
