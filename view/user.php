<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $user["name"]; ?></title>
    </head>
    <body>
<?php
    if( isset($_SESSION["user_id"]) || isset($_SESSION["store_id"])  ){
        if($_SESSION["user_id"] === $user["user_id"]){
            include("profilemenu.php");
        }
        else{
            include("menu.php");
        }
    }
?>
        <h1><?php echo $user["name"]; ?></h1>
        <div class="bio">
            <p>Bio:<?php echo $user["bio"]; ?></p>
            <p>Email:<?php echo $user["email"]; ?></p>
            <p>Criado a:<?php echo $user["created_at"]; ?></p>
        </div>
<?php
    if( !$user["is_private"] || $_SESSION["user_id"] === $user["user_id"] || isset($_SESSION["is_admin"]) ){
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
                    if( isset($_SESSION["user_id"]) ) {
                        if( $_SESSION["user_id"] === $user["user_id"] && $_SESSION["user_id"] ){
                            echo '
                            <a href="' .BASE_PATH. 'groupinteract/editgroup/' .$userCreatedGroup["group_id"]. '"> [Editar Playgroup] </a>
                            <form method="post" action="' .BASE_PATH. 'groupinteract/deletegroup">
                                <input type="hidden" name="group" value="' .$userCreatedGroup["group_id"]. '">
                                <button type="submit" onclick="return confirm(' ."'". 'Tem a certeza que quer apagar este Playgroup?' ."'". ');" name="send"> [Apagar Playgroup] </button>
                            </form>
                            ';
                        }
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