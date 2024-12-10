<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cement Sale</title>
        <link rel="stylesheet" href="../../../Views/css/Home/style.css">
        <link rel="stylesheet" href="../../../Views/css/Home/modals.css">
</head>
<body>
        <header>
                <div>
                        <span>Cement Sale</span>
                        <ul id="menu" class="menu">
                                <li><a href="#home">Home</a></li>
                                <?php foreach($cements as $cement): ?>
                                        <li><a href="#<?= $cement['name'] ?>"><?= strtoupper($cement['name'])?></a></li>
                                <?php endforeach ?>
                        </ul>
                        <svg onclick="toggle_menu()" class="display_svg" version="1.1" id="open" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.88px" height="29.956px" viewBox="0 0 122.88 29.956" enable-background="new 0 0 122.88 29.956" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M122.88,14.978c0,8.271-6.708,14.979-14.979,14.979s-14.976-6.708-14.976-14.979 C92.926,6.708,99.631,0,107.901,0S122.88,6.708,122.88,14.978L122.88,14.978z M29.954,14.978c0,8.271-6.708,14.979-14.979,14.979 S0,23.248,0,14.978C0,6.708,6.705,0,14.976,0S29.954,6.708,29.954,14.978L29.954,14.978z M76.417,14.978 c0,8.271-6.708,14.979-14.979,14.979c-8.27,0-14.978-6.708-14.978-14.979C46.46,6.708,53.168,0,61.438,0 C69.709,0,76.417,6.708,76.417,14.978L76.417,14.978z"/></g></svg>
                        <svg onclick="toggle_menu()" class="hide_svg" version="1.1" id="close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.878px" height="122.88px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g><path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/></g></svg>
                </div>
                <div class="erase_message"></div>
        </header>

        <section id="home">
                <h1>Bienvenue sur notre site de vente de ciment en ligne. </h1>
                <p>Les types de ciment disponibles sont les suivants:</p>
                <ol type="I" class="list">
                        <?php foreach($cements as $cement): ?>
                                <li>
				<?php 
				echo strtoupper( $cement['name']);  
				$type = false; 
				foreach($standards as $standard){
					if($standard['cement_id'] == $cement['id']){
						$type = true; 
					} 
				}?>

				<?php if($type): ?>
					<br>Les standards existants de ce ciment sont:
					<ol type="i">
                                        <?php foreach($standards as $standard):
                                                if($standard['cement_id'] == $cement['id']): ?>

							<li><?= $standard['name'] ?> <br>Quantité totale disponible: <?= $standard['quantity'] ?> sacs de 50 kilogrammes chacun à <?= $standard['unit_price'] ?> BIF le sac</li>
						
						<?php endif ?>
										
					<?php endforeach ?>
					</ol>

				<?php else: ?><br>Quantité totale disponible: <?= $cement['quantity'] ?> sacs de 50 kilogrammes chacun chacun à <?= $cement['unit_price'] ?> BIF le sac

				<?php endif ?>
                                </li>

                        <?php endforeach ?>
                </ol>
                <button onclick="form_open() ">Achetez-en dès maintenant en cliquant sur ce bouton</button>
        </section>

        <?php foreach($cements as $cement): ?>

                <section id="<?= $cement['name'] ?>">
                        <h1><?= strtoupper($cement['name']) ?></h1>
                        <p><?= ucfirst($cement['description']) ?></p>
                        <div class="pictures">
                                <img src="../../../Views/Images/buceco/logo.png" alt="i1" id="i1">
                        </img>
                </section>

        <?php endforeach ?>


        <svg id="chatbot" onclick="chatbot_open() " data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 107.09"><title>chat-bubble</title><path d="M63.08,0h.07C79.93.55,95,6.51,105.75,15.74c11,9.39,17.52,22.16,17.11,36.09v0a42.67,42.67,0,0,1-7.58,22.87A55,55,0,0,1,95.78,92a73.3,73.3,0,0,1-28.52,8.68,62.16,62.16,0,0,1-27-3.63L6.72,107.09,16.28,83a49.07,49.07,0,0,1-10.91-13A40.16,40.16,0,0,1,.24,45.55a44.84,44.84,0,0,1,9.7-23A55.62,55.62,0,0,1,26.19,8.83,67,67,0,0,1,43.75,2,74.32,74.32,0,0,1,63.07,0Zm24.18,42a7.78,7.78,0,1,1-7.77,7.78,7.78,7.78,0,0,1,7.77-7.78Zm-51.39,0a7.78,7.78,0,1,1-7.78,7.78,7.79,7.79,0,0,1,7.78-7.78Zm25.69,0a7.78,7.78,0,1,1-7.77,7.78,7.78,7.78,0,0,1,7.77-7.78Zm1.4-36h-.07A68.43,68.43,0,0,0,45.14,7.85a60.9,60.9,0,0,0-16,6.22A49.65,49.65,0,0,0,14.66,26.32,38.87,38.87,0,0,0,6.24,46.19,34.21,34.21,0,0,0,10.61,67,44.17,44.17,0,0,0,21.76,79.67l1.76,1.39L16.91,97.71l23.56-7.09,1,.38a56,56,0,0,0,25.32,3.6,67,67,0,0,0,26.16-8A49,49,0,0,0,110.3,71.36a36.86,36.86,0,0,0,6.54-19.67v0c.35-12-5.41-23.1-15-31.33C92.05,11.94,78.32,6.52,63,6.06Z"/></svg>

        <?php require_once 'modal.php' ?>

        <script src="../../../Views/js/Home/script.js"></script>
        <script src="../../../Views/js/Home/data_processing.js"></script>
</body>
</html>