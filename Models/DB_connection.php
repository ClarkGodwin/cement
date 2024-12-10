<?php

class DB_connection{
        private $dsn = 'mysql:host=localhost;dbname=cement_sale',
                $username = 'root',
                $password = 'g0j0sat0ru',
                $pdo;

        private static $instance, $count = 0; 

        public function __construct(){
                try{
                        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
                        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e){
                        echo "Connection Error: ". $e->getMessage();
                }
        }

        public static function get_instance(){
                if(self::$instance == NULL){
                        self::$instance = new DB_connection(); 
                }
                return self::$instance; 
        }

        public function get_connection(){
                return $this->pdo; 
        }
}
