<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $user[0]["name"]; ?></title>
    </head>
    <body>
<?php
    if($_SESSION["user_id"] === $user[0]["user_id"]){
        include("profilemenu.php");
    }
    else{
        include("menu.php");        
    }
?>
        <h1><?php echo $user[0]["name"]; ?></h1>
        <div class="bio">
            <p><?php echo $user[0]["bio"]; ?></p>
            <p><?php echo $user[0]["email"]; ?></p>
            <p><?php echo $user[0]["created_at"]; ?></p>
        </div>
<?php
    if( !$user[0]["is_private"] || $_SESSION["user_id"] === $user[0]["user_id"] ){
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
                        echo '<a href="' .BASE_PATH. 'stores/' .$userGroup["store_id"]. '">' .$userGroup["store_name"]. '</a>';
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
            <h2>PlayGroups Criados:</h2>
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
                    if( $_SESSION["user_id"] === $user[0]["user_id"] ){
                        echo '
                        <a href="' .BASE_PATH. 'groupinteract/editgroup/' .$userCreatedGroup["group_id"]. '"> [Editar Playgroup] </a>
                        <form method="post" action="' .BASE_PATH. 'groupinteract/deletegroup">
                            <input type="hidden" name="group" value="' .$userCreatedGroup["group_id"]. '">
                            <button type="submit" name="send"> [Apagar Playgroup] </button>
                        </form>
                        ';
                    }
                echo '
                </li>
                ';
            }
            echo'
            </ul>
            ';
        }
    }
    include("footer.php");
?>
    </body>
</html>