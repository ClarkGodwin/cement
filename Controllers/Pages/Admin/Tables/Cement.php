<?php

include '../../../../Models/Database.php';

$DB = new Database('cement'); 
$cements = $DB->find_all(); 

$id = 0;
$action = ''; 

if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['action']) && $_GET['action'] == 'details'){
                $action = 'details'; 
                $id = $_GET['id']; 
        }

$cement_detailed = $DB->find($id); 

ob_start();
?>

<table>
        <caption>La table Cement</caption>

        <thead>
                <th>Nom</th>
                <th>Déscription</th>
                <th>Quantité</th>
                <th>Action</th>
        </thead>

        <tbody>
                <?php foreach($cements as $cement): ?>
                        <tr>
                                <td><?= ucfirst($cement['name']) ?> </td>
                                <td><?= ucfirst(substr($cement['description'], 0, 30). '...') ?> </td>
                                <td><?= $cement['quantity']. ' sacs' ?> </td>
                                <td>
                                        <button class="details" id="<?= $cement['id'] ?>">Détails</button>
                                        <button>Modifier</button>
                                        <button>Supprimer</button>
                                </td>
                        </tr>
                <?php endforeach ?>
        </tbody>
</table>

<section class="modal hide_modal">
        <?php if($action == 'details'): ?>
                <div>
                        <svg onclick="modal_close() " version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.878px" height="122.88px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/></g></svg>
                        <p>Nom : <?= ucfirst($cement_detailed['name']) ?></p>
                </div>
        <?php endif ?>
</section>

<?php

$content = ob_get_clean(); 

$link = '../../../Views/css/Admin/Tables/Cement.css'; 

        $data = [
                'content' => $content,
                'link' => $link
        ];

        echo json_encode($data); 
}
