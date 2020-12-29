<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Zona de Administrador</title>
    </head>
    <body>
<?php
    if( isset($_SESSION["is_admin"]) ) {
        include("menu.php");  
    }
?>
        <h1>Zona de Administrador</h1>
        <div>
            <h2>Lista de Utilizadores:</h2>
            <ul>
<?php
    foreach($users as $user) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'users/' .$user["user_id"]. '">' .$user["name"]. '</a>
            <p>Email [' .$user["email"]. ']</p>
            <p>Criado a [' .$user["created_at"]. ']</p>';
            if( $user["is_private"] ){
                echo '<p> »Utilizador com perfil privado« </p>';
            }
            echo '
            <a href="' .BASE_PATH. 'profileinteract/updateprofile/user/' .$user["user_id"]. '"> [Editar Utilizador] </a>
            <form method="post" action="' .BASE_PATH. 'profileinteract/delete">
                <input type="hidden" name="user" value="' .$user["user_id"]. '">
                <button type="submit" onclick="return confirm(' ."'". 'Tem a certeza que quer apagar este utilizador?' ."'". ');"  name="send"> [Apagar Utilizador] </button>
            </form>
        </li>
        ';
    }
?>
            </ul>
        </div>
        <div>
            <h2>Lista de Lojas:</h2>
            <ul>
<?php
    foreach($stores as $store) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'stores/' .$store["store_id"]. '">' .$store["name"]. '</a>
            <p>Email [' .$store["email"]. ']</p>
            <p>Morada [' .$store["address"]. ']</p>
            <p>Cidade [' .$store["city"]. ']</p>
            <a href="' .BASE_PATH. 'profileinteract/updateprofile/store/' .$store["store_id"]. '"> [Editar Loja] </a>
            <form method="post" action="' .BASE_PATH. 'profileinteract/delete">
                <input type="hidden" name="store" value="' .$store["store_id"]. '">
                <button type="submit" onclick="return confirm(' ."'". 'Tem a certeza que quer apagar esta Loja?' ."'". ');" name="send"> [Apagar Loja] </button>
            </form>
        </li>
        ';
    }
?>
            </ul>
        </div>
        <div>
            <h2>Lista de Playgroups</h2>
            <ul>
<?php
    foreach($groups as $group) {
        echo '
        <li>
            <a href="' .BASE_PATH. 'groups/' .$group["group_id"]. '">' .$group["group_name"]. '</a>
            <p>Vamos jogar [' .$group["game_name"]. ']</p>
            <p>Criado a [' .$group["created_at"]. ']</p>';
            if( empty($group["creator_id"]) ){
                echo '<a href="' .BASE_PATH. 'stores/' .$group["store_id"]. '">Criado por [' .$group["store_name"]. ']</a>';
            }
            else{
                echo '<a href="' .BASE_PATH. 'users/' .$group["creator_id"]. '">Criado por [' .$group["creator_name"]. ']</a>';
            }
            echo '
            <a href="' .BASE_PATH. 'groupinteract/editgroup/' .$group["group_id"]. '/admin"> [Editar Playgroup] </a>
            <form method="post" action="' .BASE_PATH. 'groupinteract/deletegroup">
                <input type="hidden" name="adminDelete" value="' .$group["group_id"]. '">
                <button type="submit" onclick="return confirm(' ."'". 'Tem a certeza que quer apagar este Playgroup?' ."'". ');" name="send"> [Apagar Playgroup] </button>
            </form>
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