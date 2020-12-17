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
        <ul>
<?php
    foreach($groups as $group) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'groups/' .$group["group_id"]. '">' .$group["group_name"]. '</a>
            <p>' .$group["game_name"]. '</p>
            <p>' .$group["created_at"]. '</p>
            <a href="' .BASE_PATH. 'users/' .$group["creator_id"]. '">' .$group["creator_name"]. '</a>
        </li>
        ';
    }
?>
        </ul>
<?php
    include("footer.php");
?>
    </body>
</html>