<nav>
    <a href="<?=BASE_PATH?>groups">Home</a>
    <a href="<?=BASE_PATH?>choosestore">Criar um Playgroup</a>
    <a href="<?=BASE_PATH?>profileinteract/updateprofile">Actualizar Perfil</a>
    <a href="<?=BASE_PATH?>myplaygroups">Os meus Playgroups</a>
<?php
    if( isset($_SESSION["user_id"]) ) {

?>
        <form method="post" action="<?=BASE_PATH?>profileinteract/updateprivacy">
<?php
        if($user[0]["is_private"]){
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