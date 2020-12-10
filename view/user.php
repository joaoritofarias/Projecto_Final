<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?php echo $userGroups[0]["name"]; ?></title>
    </head>
    <body>
        <h1><?php echo $userGroups[0]["name"]; ?></h1>
        <div class="bio">
            <p><?php echo $userGroups[0]["email"]; ?></p>
            <p><?php echo $userGroups[0]["city"]; ?></p>
            <p><?php echo $userGroups[0]["country"]; ?></p>
        </div>
        <h2>PlayGroups</h2>
        <ul>
<?php
    foreach($userGroups as $userGroup) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'groups/' .$userGroup["group_id"]. '">' .$userGroup["group_name"]. '</a>
            <p>' .$userGroup["game_name"]. '</p>
            <p>' .$userGroup["created_at"]. '</p>
            <p>' .$userGroup["name"]. '</p>
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