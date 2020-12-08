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
            <a href="groups/' .$group["group_id"]. '">' .$group["group_name"]. '</a>
            <p>' .$group["game_name"]. '</p>
            <p>' .$group["created_at"]. '</p>
            <p>' .$group["creator_name"]. '</p>
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