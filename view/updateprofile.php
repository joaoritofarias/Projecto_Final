<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Actualize o seu perfil</title>
        <script src="/ckeditor/ckeditor.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>Actualize o seu perfil</h1>
<?php
    if(isset($message)) { echo '<p role="alert">' .$message. '</p>'; };
?> 
        <div id="editProfileForm">
<?php
    if( isset($_SESSION["is_admin"]) && isset($secondAction) && isset($thirdAction) ){
?>
            <form method="post" action="<?=BASE_PATH?>profileinteract/updateprofile/<?=$secondAction?>/<?=$thirdAction?>">
<?php
    }
    else{
?>
            <form method="post" action="<?=BASE_PATH?>profileinteract/updateprofile">
<?php
    }
?>
                <div>
                    <label>
                        Nome
                        <input type="text" name="name" maxlength="64" autofocus>
                    </label>
                </div>
                <div>
                    <label>
                        Email
                        <input type="email" name="email">
                    </label>
                </div>
<?php
    if( isset($_SESSION["user_id"]) & !isset($secondAction) || isset($_SESSION["is_admin"]) && $secondAction === "user"  ){
?>
                <div>
                    <label>
                        Sobre mim
                        <textarea name="bio" id="myeditor"></textarea>
                    </label>
                </div>
<?php
    }
    elseif( isset($_SESSION["store_id"]) & !isset($secondAction) || isset($_SESSION["is_admin"]) && $secondAction === "store" ){
?>
                <div>
                    <label>
                        Morada
                        <input type="text" name="address" maxlength="255">
                    </label>
                </div>
                <div>
                    <label>
                        Cidade
                        <input type="text" name="city" maxlength="64">
                    </label>
                </div>
<?php
    }
?>
                <div>
                    <button type="submit" name="send">Actualizar</button>
                    <a href="<?=BASE_PATH?>groups">Cancelar</a>
                </div>
            </form>
        </div>
    <script src="/scripts/ckeditorscript.js"></script>
    </body>
</html>