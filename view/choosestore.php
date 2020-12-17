<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Escolha uma loja:</title>
    </head>
    <body>
        <h1>Escolha uma loja:</h1>
        <ul>
<?php
    foreach($stores as $store) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'groupinteract/creategroup/' .$store["store_id"]. '">' .$store["name"]. '</a>
        </li>
        ';
    }
?>
        </ul>
        <a href="<?=BASE_PATH?>groups">Cancelar</a>
    </body>
</html>