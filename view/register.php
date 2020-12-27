<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Criar Conta</title>
        <link rel="stylesheet" href="/css/register.css">
    </head>
    <body>
        <h1>Criar Conta</h1>
<?php
    if(isset($message)) { echo '<p role="alert">' .$message. '</p>'; };
?> 
        <div>
            <label>
                Tipo de utilizador:
                <label>
                    Jogador
                    <input type="radio" id="userRadio" name="userType" onclick="hideStoreForm()" checked>
                </label>
                <label>
                    Loja
                    <input type="radio" id="storeRadio" name="userType" onclick="showStoreForm()">
                </label>
            </label>
        </div>
        <div id="userForm">
            <form method="post" action="<?=BASE_PATH?>access/register">
                <div>
                    <label>
                        Nome
                        <input type="text" name="name" minlength="2" maxlength="64"required autofocus>
                    </label>
                </div>
                <div>
                    <label>
                        Email
                        <input type="email" name="email" required>
                    </label>
                </div>
                <div>
                    <label>
                        Password
                        <input type="password" name="password" minlength="8" maxlength="1000"required >
                    </label>
                </div>
                <div>
                    <label>
                        Repetir Password
                        <input type="password" name="rep_password" minlength="8" maxlength="1000" required>
                    </label>
                </div>
                <div>
                <input type="hidden" name="user_type" value="user">
                <button type="submit" name="send">Registar</button>
                </div>
            </form>
        </div>
        <div id="storeForm">
            <form method="post" action="<?=BASE_PATH?>access/register">
                <div>
                    <label>
                        Nome
                        <input type="text" name="name" required minlength="2" maxlength="64"required autofocus>
                    </label>
                </div>
                <div>
                    <label>
                        Email
                        <input type="email" name="email" required>
                    </label>
                </div>
                <div>
                    <label>
                        Password
                        <input type="password" name="password" minlength="8" maxlength="1000"required >
                    </label>
                </div>
                <div>
                    <label>
                        Repetir Password
                        <input type="password" name="rep_password" minlength="8" maxlength="1000" required>
                    </label>
                </div>
                <div>
                    <label>
                        Morada
                        <input type="text" name="address" maxlength="255"required >
                    </label>
                </div>
                <div>
                    <label>
                        Cidade
                        <input type="text" name="city" maxlength="64"required >
                    </label>
                </div>
                <div>
                <input type="hidden" name="user_type" value="store">
                <button type="submit" name="send">Registar</button>
                </div>
            </form>
        </div>

        <script src="/scripts/register.js"></script>
    </body>
</html>