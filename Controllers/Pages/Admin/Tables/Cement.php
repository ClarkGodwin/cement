<?php

include '../../../../Models/Database.php';

$DB = new Database('cement'); 
$cements = $DB->find_all(); 

// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//         $detail_id = $_POST['id']; 
// }

// $cement_detailed = $DB->find($detail_id); 

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
                                        <button onclick="details(<?= $cement['id'] ?>)">Détails</button>
                                        <button>Modifier</button>
                                        <button>Supprimer</button>
                                </td>
                        </tr>
                <?php endforeach ?>
        </tbody>
</table>

<section class="modal hide_modal">
        <div class="details hide_modal">
        </div>
</section>

<?php

$content = ob_get_clean(); 

$link = '../../../Views/css/Admin/Tables/Cement.css'; 

if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $data = [
                'content' => $content,
                'link' => $link
        ];

        echo json_encode($data); 
}
