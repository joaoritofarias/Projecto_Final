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
        if( isset($_SESSION["store_id"]) ){
?>
            <a href="<?=BASE_PATH?>users/<?=$_SESSION["store_id"]?>">Profile</a>
<?php
        }
        else{
?>
        <a href="<?=BASE_PATH?>users/<?=$_SESSION["user_id"]?>">Profile</a>
<?php
    }
}
?>
</nav>
