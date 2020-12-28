<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Alterar Password</title>
    </head>
    <body>
        <h1>Alterar Password</h1>
<?php
    if(isset($message)) { echo '<p role="alert">' .$message. '</p>'; };
?> 
        <div id="storeForm">
            <form method="post" action="<?=BASE_PATH?>profileinteract/changepassword">
                <div>
                    <label>
                        Password Antiga
                        <input type="password" name="oldpassword" minlength="8" maxlength="1000"required >
                    </label>
                </div>
                    <label>
                        Nova Password
                        <input type="password" name="newpassword" minlength="8" maxlength="1000"required >
                    </label>
                </div>
                <div>
                    <label>
                        Repetir Nova Password
                        <input type="password" name="rep_newpassword" minlength="8" maxlength="1000" required>
                    </label>
                </div>
                <div>
                <button type="submit" name="send">Alterar password</button>
                <a href="<?=BASE_PATH?>groups">Cancelar</a>
                </div>
            </form>
        </div>
    </body>
</html>