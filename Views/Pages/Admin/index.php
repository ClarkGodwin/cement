<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="../../../Views/css/Admin/style.css">
        <?= isset($link)? $link:'' ?>
</head>
<body>
        <nav>
                <ul>
                        <li class="active">Dashboard</li>
                        <?php foreach($tables as $table): ?>
                                <li><?= ucfirst($table) ?></li>
                        <?php endforeach ?>
                </ul>
        </nav>
        <section class="content">
                <span class="erase_message">L'element a ete modifie avec succes</span>
                <div>
                       <?= $content ?> 
                </div>
        </section>
        <script src="../../../Views/js/Admin/script.js"></script>

</body>
</html>