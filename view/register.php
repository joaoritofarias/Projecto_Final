<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Criar Conta</title>
    </head>
    <body>
        <h1>Criar Conta</h1>
<?php
    if(isset($message)) { echo '<p role="alert">' .$message. '</p>'; };
?>
        <form method="post" action="/access/register">
            <div>
                <label>
                    Nome
                    <input type="text" name="name" required minlength="2" maxlength="64">
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
                    <input type="password" name="password" required minlength="8" maxlength="1000">
                </label>
            </div>
            <div>
                <label>
                    Repetir Password
                    <input type="password" name="rep_password" required minlength="8" maxlength="1000">
                </label>
            </div>
            <div>
                <label>
                    Cidade
                    <input type="text" name="city" required maxlength="64">
                </label>
            </div>
            <div>
                <label>
                    País
                    <input type="text" name="country" required maxlength="32">
                </label>
            </div>
  
            <div>
                <button type="submit" name="send">Registar</button>
            </div>
        </form>
    </body>
</html>