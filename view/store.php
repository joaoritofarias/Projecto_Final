<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $store["name"]; ?></title>
    </head>
    <body>
<?php
    if( isset($_SESSION["store_id"]) ) {
        if($_SESSION["store_id"] === $store["store_id"]){
            include("profilemenu.php");
        }
    }
    else{
        include("menu.php");        
    }
?>
        <h1><?php echo $store["name"]; ?></h1>
        <div class="bio">
            <p><?php echo $store["email"]; ?></p>
            <p><?php echo $store["address"]; ?></p>
            <p><?php echo $store["city"]; ?></p>
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
                <p>' .$storeCreatedGroup["created_at"]. '</p>';
                if( $_SESSION["store_id"] === $store["store_id"] ){
                    echo '
                    <a href="' .BASE_PATH. 'groupinteract/editgroup/' .$storeCreatedGroup["group_id"]. '"> [Editar Playgroup] </a>
                    <form method="post" action="' .BASE_PATH. 'groupinteract/deletegroup">
                        <input type="hidden" name="group" value="' .$storeCreatedGroup["group_id"]. '">
                        <button type="submit" name="send"> [Apagar Playgroup] </button>
                    </form>
                    ';
                }
            echo'
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