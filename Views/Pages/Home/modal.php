<div id="modal">
        <div class="modal">
                <svg onclick="modal_close() " version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.878px" height="122.88px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/></g></svg>
                <form action="" method="POST">
                        <label for="last_name">Nom de famille</label>
                        <input type="text" name="last_name" id="last_name">
                        <label for="first_name">Prénom</label>
                        <input type="text" name="first_name" id="first_name">
                        <label for="num_phone">Numéro</label>
                        <input type="tel" name="num_phone" id="num_phone">
                        <label for="address">Addresse</label>
                        <input type="text" name="address" id="address">
                        <label for="cement">Type de ciment</label>
                        <select name="cement" id="cement">
                                <?php foreach($cements as $cement): ?>
                                        <?php foreach($standards as $standard): 
                                                if($standard['cement_id'] == $cement['id']): ?>
                                                        <option value="<?=$cement['id'].'.'.$standard['id']?> ">
                                                                <?=strtoupper($cement['name']).' de type '.$standard['name'] ?>
                                                        </option>
                                                <?php else: ?>
                                                        <option value="<?= $cement['id'] ?> ">
                                                                <?= strtoupper($cement['name']) ?></option>
                                                <?php break;  endif ?>
                                        <?php endforeach ?>
                                <?php endforeach ?>
                        </select>
                        <label for="nbr">Nombre de sacs</label>
                        <input type="number" name="nbr" id="nbr">
                        <button type="submit">continuer</button>
                </form>
        </div>

        <div>
                <svg onclick="modal_close() " version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.878px" height="122.88px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/></g></svg>
                <form action="" method="POST">
                        <label for="message">Message</label>
                        <input type="text" name="message" id="message">
                        <button type="submit">continuer</button>
                </form>
                <section class="discussion">
                </section>
        </div>
</div>
