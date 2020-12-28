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
            <form method="post" action="<?=BASE_PATH?>profileinteract/updateprofile">
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
    if( isset($_SESSION["user_id"]) ){
?>
                <div>
                    <label>
                        Sobre mim
                        <textarea name="bio" id="myeditor"></textarea>
                    </label>
                </div>
                <a href="<?=BASE_PATH?>users/<?=$_SESSION["user_id"]?>">Cancelar</a>
<?php
    }
    elseif( isset($_SESSION["store_id"]) ){
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
                <a href="<?=BASE_PATH?>stores/<?=$_SESSION["store_id"]?>">Cancelar</a>
<?php
    }
?>
                <div>
                <button type="submit" name="send">Actualizar</button>
                </div>
            </form>
        </div>
    <script src="/scripts/ckeditorscript.js"></script>
    </body>
</html>