<nav>
<?php
    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
?>
        <a href="<?=BASE_PATH?>access/login">Login</a>
        <a href="<?=BASE_PATH?>access/register">Criar Conta</a>
<?php
    }
    else {
?>
        <a href="<?=BASE_PATH?>groups">Home</a>
<?php
    }
?>
</nav>
