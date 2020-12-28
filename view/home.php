<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>PlayGroups</title>
    </head>
    <body>
        <h1>PlayGroups</h1>
<?php
    include("menu.php");
?>
        <div>
            <h2>Playgroups mais recentes:</h2>
            <ul>
<?php
    foreach($groups as $group) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'groups/' .$group["group_id"]. '">' .$group["group_name"]. '</a>
            <p>Vamos jogar [' .$group["game_name"]. ']</p>
            <p>Criado a [' .$group["created_at"]. ']</p>';
            if( empty($group["creator_id"]) ){
                echo '<a href="' .BASE_PATH. 'stores/' .$group["store_id"]. '">Criado por [' .$group["store_name"]. ']</a>';
            }
            else{
                echo '<a href="' .BASE_PATH. 'users/' .$group["creator_id"]. '">Criado por [' .$group["creator_name"]. ']</a>';
            }
        echo '
        </li>
        ';
    }
?>
            </ul>
        </div>
<?php
    include("footer.php");
?>
    </body>
</html>