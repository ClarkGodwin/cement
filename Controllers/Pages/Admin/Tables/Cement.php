<?php

include '../../../../Models/Database.php';

$DB = new Database('cement'); 
$cements = $DB->find_all(); 

$id = 0;
$action = ''; 

if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['action'])){
                $action = $_GET['action']; 
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
                                        <button class="modifier">Modifier</button>
                                        <button>Supprimer</button>
                                </td>
                        </tr>
                <?php endforeach ?>
        </tbody>
</table>

<section class="modal hide_modal">
        <?php $related_standard = $DB->set_table_name('standard')->find_with_column('cement_id', $cement_detailed['id']);
        if($action == 'details'){ ?>
                <div>
                        <svg onclick="modal_close() " version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.878px" height="122.88px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/></g></svg>
                        <p><h4>Nom</h4> : <?= ucfirst($cement_detailed['name']) ?></p>
                        <p><h4>Déscription</h4> : <?= ucfirst($cement_detailed['description']) ?></p>
                        <p><h4>Quantité</h4> : <?= $cement_detailed['quantity'] ?> sacs de 50 kg</p>
                        <?php if(count($related_standard) == 0){?>
                                <p><h4>Prix unitaire</h4> : <?= $cement_detailed['unit_price'] ?>BIF</p>
                        <?php } ?>
                </div>

        <?php ;} else if($action == 'modifier'){ ?>
                <div>
                        <svg onclick="modal_close() " version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.878px" height="122.88px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/></g></svg>
                        <form action="" id="modifying_form">
                                <input type="hidden" name="table_name" id="table_name" value="cement">
                                <input type="hidden" name="id" id="id" value="<?= $cement_detailed['id']?>">
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name" value="<?= ucfirst($cement_detailed['name']) ?>">
                                <label for="description">Déscription</label>
                                <textarea name="description" id="description">
                                        <?= $cement_detailed['description'] ?> 
                                </textarea>
                                <label for="quantity">Quantité</label>
                                <input type="number" name="quantity" id="quantity" value="<?= $cement_detailed['quantity']?>">
                                <?php if(count($related_standard) == 0){?>
                                        <label for="unit_price">Prix unitaire</label>
                                        <input type="number" name="unit_price" id="unit_price" value="<?= $cement_detailed['unit_price']?>">
                                        <input type="hidden" name="standard" id="standard" value="no">
                                <?php } ?>
                                <button type="submit">continuer</button>
                        </form>
                </div>
        <?php ; } ?>
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
