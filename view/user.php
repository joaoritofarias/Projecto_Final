<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $user[0]["name"]; ?></title>
    </head>
    <body>
<?php
    include("menu.php");
?>
        <h1><?php echo $user[0]["name"]; ?></h1>
        <div class="bio">
            <p><?php echo $user[0]["bio"]; ?></p>
            <p><?php echo $user[0]["created_at"]; ?></p>
        </div>
<?php
    if( !empty($userGroups) ){
        echo'
        <h2>PlayGroups:</h2>
        <ul>
        ';
        foreach($userGroups as $userGroup) {
            echo '
            <li>
                <a href="' .BASE_PATH. 'groups/' .$userGroup["group_id"]. '">' .$userGroup["group_name"]. '</a>
                <p>' .$userGroup["game_name"]. '</p>
                <p>' .$userGroup["created_at"]. '</p>';
                if( empty($_SESSION["store_id"]) ){
                    echo '<a href="' .BASE_PATH. 'store/' .$userGroup["store_id"]. '">' .$userGroup["store_name"]. '</a>';
                }
            echo '
            </li>
            ';
        }
        echo'
        </ul>
        ';
    }
    if( !empty($userCreatedGroups) ){
        echo'
        <h2>My Created PlayGroups:</h2>
        <ul>
        ';
        foreach($userCreatedGroups as $userCreatedGroup) {
            echo '
            <li>
                <a href="' .BASE_PATH. 'groups/' .$userCreatedGroup["group_id"]. '">' .$userCreatedGroup["group_name"]. '</a>
                <p>' .$userCreatedGroup["game_name"]. '</p>
                <p>' .$userCreatedGroup["created_at"]. '</p>';
                if( empty($_SESSION["store_id"]) ){
                    echo '<a href="' .BASE_PATH. 'store/' .$userCreatedGroup["store_id"]. '">' .$userCreatedGroup["store_name"]. '</a>';
                }
            echo '
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