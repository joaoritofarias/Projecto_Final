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
        <a href="<?=BASE_PATH?>choosestore">Criar um Playgroup</a>
        <a href="<?=BASE_PATH?>searchgroups">Procurar um Playgroup</a>
<?php
        if( isset($_SESSION["store_id"]) ){
?>
            <a href="<?=BASE_PATH?>stores/<?=$_SESSION["store_id"]?>">Perfil</a>
<?php
        }
        else{
?>
                <a href="<?=BASE_PATH?>users/<?=$_SESSION["user_id"]?>">Perfil</a>
<?php
    }
}
?>
</nav>
