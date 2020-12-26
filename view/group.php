<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $group["group_name"]; ?></title>
    </head>
    <body>
<?php
    include("menu.php");
?>
        <h1><?php echo $group["group_name"]; ?></h1>
        <main>
            <div class="gameName">
                <?php echo $group["game_name"]; ?>
            </div>
            <div class="description">
                <?php echo $group["description"]; ?>
            </div>
            <div class="groupDate">
                <?php echo $group["group_date"]; ?>
            </div>
            <div class="totalPlayers">
                <?php echo $group["total_players"]; ?>
            </div>
            <div class="createdAt">
                <?php echo $group["created_at"]; ?>
            </div>
            <div class="creatorName">
                <?php echo '<a href="' .BASE_PATH. 'users/' .$group["creator_id"]. '">' .$group["creator_name"]. '</a>'; ?>
            </div>
            <div class="storeName">
                <?php echo '<a href="' .BASE_PATH. 'stores/' .$group["store_id"]. '">' .$group["store_name"]. '</a>'; ?>
            </div>
        </main>
        <div class = "joinedUsersList">
            <h2>Utilizadores neste Playgroup:</h2>
<?php
    if(empty($joinedUsers)) {
        echo "<p>Ainda não existem utilizadores inscritos neste Playgroup</p>";
    }
    else {
        if( count($joinedUsers) === (int)$group["total_players"] ){
            echo "<p>!!!Playgroup Cheio!!!</p>";
        }
?>            
            <ul>
<?php
        foreach($joinedUsers as $joinedUser) {
            echo '
            <li>
                <a href="' .BASE_PATH. 'users/' .$joinedUser["user_id"]. '">' .$joinedUser["username"]. '</a>
            </li>
            ';
            }
    }
?>
            </ul>

<?php
        if( isset($_SESSION["user_id"]) && 
            $_SESSION["user_id"] !== $group["creator_id"] &&
            !in_array( $_SESSION["user_id"], array_column($joinedUsers, "user_id") ) &&
            count($joinedUsers) !== (int)$group["total_players"] 
        ){
            echo'
            <div>
                <form method="post" action="' .BASE_PATH. 'joinedusers/subscribe">
                    <input type="hidden" name="group" value="' .$group["group_id"]. '">
                    <button type="submit" name="subscribe">Aderir a este Playgroup</button>
                </form>
            </div>
            ';
        }
        elseif( isset($_SESSION["user_id"]) && 
                $_SESSION["user_id"] !== $group["creator_id"] && 
                in_array( $_SESSION["user_id"], array_column($joinedUsers, "user_id") ) 
            ){
            echo'
            <div>
                <form method="post" action="' .BASE_PATH. 'joinedusers/unsubscribe">
                    <input type="hidden" name="group" value="' .$group["group_id"]. '">
                    <button type="submit" name="unsubscribe">Sair deste Playgroup</button>
                </form>
            </div>
            ';
        }
?>
        </div>
<?php
    include("footer.php");
?>
    </body>
</html>