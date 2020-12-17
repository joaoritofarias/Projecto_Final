<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $group["group_name"]; ?></title>
    </head>
    <body>
        <h1><?php echo $group["group_name"]; ?></h1>
<?php
    include("menu.php");
?>
        <main>
            <div class="gameName"><?php echo $group["game_name"]; ?></div>
            <div class="description"><?php echo $group["description"]; ?></div>
            <div class="groupDate"><?php echo $group["group_date"]; ?></div>
            <div class="totalPlayers"><?php echo $group["total_players"]; ?></div>
            <div class="createdAt"><?php echo $group["created_at"]; ?></div>
            <div class="creatorName"><?php echo '<a href="' .BASE_PATH. 'users/' .$group["creator_id"]. '">' .$group["creator_name"]. '</a>'; ?></div>
            <div class="storeName"><?php echo '<a href="' .BASE_PATH. 'stores/' .$group["store_id"]. '">' .$group["store_name"]. '</a>'; ?></div>
        </main>
<?php
    include("footer.php");
?>
    </body>
</html>