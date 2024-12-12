<?php

include 'DB_connection.php'; 

class Database{
        private $pdo,
                $table_name;  

        public function __construct($table_name){
                $this->pdo = DB_connection::get_instance()->get_connection(); 
                $this->table_name = $table_name; 
        }

        public function set_table_name($new_name){
                $this->table_name = $new_name; 
                return $this; 
        }

        public function find_all(){
                try{
                        $sql = "SELECT * FROM $this->table_name"; 
                        $stmt = $this->pdo->prepare($sql); 
                        $stmt->execute();
        
                        return $stmt->fetchAll();  
                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function find($id){
                try{
                        $sql = "SELECT * FROM $this->table_name WHERE id=:id"; 
                        $stmt = $this->pdo->prepare($sql); 
                        $stmt->bindParam(':id', $id); 
                        $stmt->execute();
        
                        return $stmt->fetch();  

                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function find_with_column($column_name, $column_value){
                try{
                        $sql = "SELECT * FROM $this->table_name WHERE $column_name=:column_value"; 
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->bindParam(':column_value', $column_value);
                        $stmt->execute(); 
        
                        return $stmt->fetchAll(); 

                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        function insert($table){
                try{
                        $columns = array_keys($table);
                        $values = array_values($table);

                        $string_columns = '';
                        $string_values = ''; 
        
                        for($i=0; $i < count($columns); $i++){
                                if($i == 0){
                                        $string_columns = "$columns[$i]"; 
                                        $string_values = ":value_$i"; 
                                }
                                else{
                                        $string_columns .= ",$columns[$i]"; 
                                        $string_values .= ",:value_$i"; 
                                }
                        }

                        $sql = "INSERT INTO $this->table_name($string_columns) VALUES($string_values)";

                        $stmt = $this->pdo->prepare($sql); 
                        
                        $string_values = explode(',', $string_values); 
                        
                        for($i=0; $i < count($columns); $i++){
                                $stmt->bindParam($string_values[$i], $values[$i]); 
                        }

                        $stmt->execute(); 
                        
                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function inserts($tables){
                foreach($tables as $table){
                        $this->insert($table); 
                }
        }

        public function delete($id){
                try{
                        $sql = "DELETE FROM $this->table_name WHERE id=:id";
                        $stmt = $this->pdo->prepare($sql); 
                        $stmt->bindParam(':id', $id);
                        $stmt->execute(); 
                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function delete_with_column($column_name, $column_value){
                try{
                        $sql = "DELETE FROM $this->table_name WHERE $column_name=:column_value";
                        $stmt = $this->pdo->prepare($sql); 
                        $stmt->bindParam(":column_value", $column_value); 
                        $stmt->execute(); 
                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function update($column_name, $column_value, $id){
                try{
                        $sql = "UPDATE $this->table_name SET $column_name=:column_value WHERE id=:id"; 
                        $stmt = $this->pdo->prepare($sql); 
                        $stmt->bindParam(':column_value', $column_value);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute(); 

                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function updates($columns, $id){
                $column_names = array_keys($columns);
                $column_values = array_values($columns);
                for($i=0; $i < count($column_names); $i++){
                        $this->update($column_names[$i], $column_values[$i], $id); 
                }
        }

        public function get_cell($column_name, $id){
                try{
                        $sql = "SELECT $column_name FROM $this->table_name WHERE id=:id";
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->bindParam(':id', $id); 
                        $stmt->execute();
                        $value = $stmt->fetch();  
        
                        return $value[$column_name]; 

                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function get_cells_with_column($column_name, $column, $column_value){
                try{
                        $sql = "SELECT DISTINCT $column_name FROM $this->table_name WHERE $column=:column_value";
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->bindParam(':column_value', $column_value); 
                        $stmt->execute();
                        $r = $stmt->fetchAll();  

                        $answer = [];
                        foreach($r as $t){
                                $answer[] = $t[$column_name]; 
                        }

                        return $answer; 
        
                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function get_cells($column_names, $id){
                try{
                        for($i=0; $i < count($column_names); $i++){
                                $value = $this->get_cell($column_names[$i], $id); 
                                $values[$column_names[$i]] = $value; 
                        }
        
                        return $values; 

                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function get_column($column_name){
                try{
                        $sql = "SELECT DISTINCT $column_name FROM $this->table_name";
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute();
                        $t = $stmt->fetchAll();  

                        $answers = [];
                        foreach($t as $r){
                                $answers[] = $r[$column_name];
                        }

                        return $answers;
        
                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function get_columns($column_names){
                try{
                        $columns = implode(',', $column_names); 
                        $sql = "SELECT DISTINCT $columns FROM $this->table_name";
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute();
                        return $stmt->fetchAll();  

                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public function show_tables(){
                try{
                        $sql = "SHOW TABLES"; 
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute(); 
                        $tables = $stmt->fetchAll();

                        $answer = []; 
                        foreach($tables as $table){
                                $answer[] = $table[0]; 
                        }

                        return $answer; 
                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }
}

$DB_connection = new Database('cement');

