<nav>
    <a href="<?=BASE_PATH?>groups">Home</a>
    <a href="<?=BASE_PATH?>choosestore">Criar um Playgroup</a>
    <a href="<?=BASE_PATH?>searchgroups">Procurar um Playgroup</a>
    <a href="<?=BASE_PATH?>profileinteract/updateprofile">Actualizar Perfil</a>
    <a href="<?=BASE_PATH?>profileinteract/changepassword">Alterar a Password</a>
<?php
    if( isset($_SESSION["user_id"]) ) {

?>
        <form method="post" action="<?=BASE_PATH?>profileinteract/updateprivacy">
<?php
        if($user["is_private"]){
?>
                <input type="hidden" name="privacy" value="0">
                <button type="submit" name="send">Tornar o meu perfil publico.</button>
<?php
        }
        else{
?>
                <input type="hidden" name="privacy" value="1">
                <button type="submit" name="send">Tornar o meu perfil privado.</button>  
<?php
        }
?>
        </form>
<?php
    }
?>
</nav>