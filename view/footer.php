<footer>
<?php
    if(isset($_SESSION["user_id"]) || isset($_SESSION["store_id"]) ) {
?>
        <a href="<?=BASE_PATH?>access/logout">>Logout<</a>
        <form method="post" action="<?=BASE_PATH?>profileinteract/delete">
                <button type="submit" onclick="return confirm('Tem a certeza que quer apagar o seu perfil?');" name="send"> >Apagar Conta< </button>
        </form>
<?php
    }
?>
</footer>