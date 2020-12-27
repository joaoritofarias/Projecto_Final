<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Procurar por Playgroups</title>
    </head>
    <body>
        <h1>Procurar por Playgroups</h1>
<?php
    include("menu.php");
?>
        <div>
            <form method="post" action="<?=BASE_PATH?>searchgroups">
                <label>
                    Procurar por:
                    <input type="text" name="searchField" required >
                </label>
                <button type="submit" name="send">Procurar</button>
            </form>
        </div>
        <div>
            <ul>
<?php
    if(isset($searchedGroups)){
        $groups = $searchedGroups;
    }
    if(empty($groups) ){
        echo "<p>Não existem Playgroups com esses parâmetros</p>";
    }

    foreach($groups as $group) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'groups/' .$group["group_id"]. '">' .$group["group_name"]. '</a>
            <p>' .$group["game_name"]. '</p>
            <p>' .$group["created_at"]. '</p>
            <a href="' .BASE_PATH. 'users/' .$group["creator_id"]. '">' .$group["creator_name"]. '</a>
        </li>
        ';
    }
?>
            </ul>
        </div>


<?php
    include("footer.php");
?>
    </body>
</html>