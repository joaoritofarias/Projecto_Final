<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
<?php
    if(isset($message)) {
        echo '<p role="alert">' .$message. '</p>';
    }
?>
        <p>Se ainda não tiver uma conta, <a href="<?=BASE_PATH?>access/register">registe-se aqui</a>.</p>
        <form method="post" action="<?=BASE_PATH?>access/login">
            <div>
                <label>
                    Tipo de utilizador:
                    <label>
                        Jogador
                        <input type="radio" id="user" name="userType" value="user" checked>
                    </label>
                    <label>
                        Loja
                        <input type="radio" id="store" name="userType" value="store">
                    </label>
                </label>
            </div>
            <div>
                <label>
                    Email
                    <input type="email" name="email" required autofocus>
                </label>
            </div>
            <div>
                <label>
                    Password
                    <input type="password" name="password" minlength="8" maxlength="1000" required>
                </label>
            </div>
            <div>
                <img src="../captcha.php">
            </div>
            <div>
                <label>
                    Escreva os caracteres mostrados em cima:
                    <input type="text" name="captcha" required>
                </label>
            </div>
            <div>
                <button type="submit" name="send">Login</button>
            </div>
        </form>
    </body>
</html>