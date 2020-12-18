<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $store[0]["name"]; ?></title>
    </head>
    <body>
<?php
    include("menu.php");
?>
        <h1><?php echo $store[0]["name"]; ?></h1>
        <div class="bio">
            <p><?php echo $store[0]["address"]; ?></p>
            <p><?php echo $store[0]["city"]; ?></p>
            <p><?php echo $store[0]["country"]; ?></p>
        </div>
<?php
    if( !empty($storeGroups) ){
        echo'
        <h2>PlayGroups:</h2>
        <ul>
        ';
        foreach($storeGroups as $storeGroup) {
            echo '
            <li>
                <a href="' .BASE_PATH. 'groups/' .$storeGroup["group_id"]. '">' .$storeGroup["group_name"]. '</a>
                <p>' .$storeGroup["game_name"]. '</p>
                <p>' .$storeGroup["created_at"]. '</p>
                <a href="' .BASE_PATH. 'users/' .$storeGroup["user_id"]. '">' .$storeGroup["creator_name"]. '</a>
            </li>
            ';
        }
        echo'
        </ul>
        ';
    }
    if( !empty($storeCreatedGroups) ){
        echo'
        <h2>PlayGroups Criados:</h2>
        <ul>
        ';
        foreach($storeCreatedGroups as $storeCreatedGroup) {
            echo '
            <li>
                <a href="' .BASE_PATH. 'groups/' .$storeCreatedGroup["group_id"]. '">' .$storeCreatedGroup["group_name"]. '</a>
                <p>' .$storeCreatedGroup["game_name"]. '</p>
                <p>' .$storeCreatedGroup["created_at"]. '</p>
            </li>
            ';
        }
        echo'
        </ul>
        ';
    }
    include("footer.php");
?>
    </body>
</html>