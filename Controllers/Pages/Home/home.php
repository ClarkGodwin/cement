<?php

include '../../../Models/Database.php'; 

$table = new Database('cement');
$cements = $table->find_all(); 

$table->set_table_name('standard'); 
$standards = $table->find_all(); 

include '../../../Views/Pages/Home/index.php'; 
