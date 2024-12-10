<?php

include '../../../Models/Database.php'; 

$DB = new Database('cement'); 

$tables = $DB->show_tables(); 

$cements = $DB->find_all();
$sales = $DB->set_table_name('sales'); 
$standard = $DB->set_table_name('standard'); 

ob_start()
?>

<link rel="stylesheet" href="">

<?php

$link = ob_get_clean(); 

ob_start();
?>

<h3 id="h3">Bienvenu sur le site d'administrateur</h3>
<p>Servez vous de la bar de navigation pour effectuer toutes sorte de modification aux tables de la base de donnees et/ou pour vous deconnecter</p>

<?php

$content = ob_get_clean(); 

include '../../../Views/Pages/Admin/index.php'; 
