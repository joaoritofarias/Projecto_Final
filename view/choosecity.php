<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Escolha uma cidade:</title>
    </head>
    <body>
        <h1>Escolha uma cidade:</h1>
        <ul>
<?php
    foreach($cities as $city) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'choosestore/' .$city["city"]. '">' .$city["city"]. '</a>
        </li>
        ';
    }
?>
        </ul>
        <a href="<?=BASE_PATH?>groups">Cancelar</a>    
    </body>
</html>