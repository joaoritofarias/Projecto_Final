<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $storeGroups[0]["name"]; ?></title>
    </head>
    <body>
<?php
    include("menu.php");
?>
        <h1><?php echo $storeGroups[0]["name"]; ?></h1>
        <div class="bio">
            <p><?php echo $storeGroups[0]["address"]; ?></p>
            <p><?php echo $storeGroups[0]["city"]; ?></p>
            <p><?php echo $storeGroups[0]["country"]; ?></p>
        </div>
        <h2>PlayGroups</h2>
        <ul>
<?php
    foreach($storeGroups as $storeGroup) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'groups/' .$storeGroup["group_id"]. '">' .$storeGroup["group_name"]. '</a>
            <p>' .$storeGroup["game_name"]. '</p>
            <p>' .$storeGroup["created_at"]. '</p>
            <p>' .$storeGroup["name"]. '</p>
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