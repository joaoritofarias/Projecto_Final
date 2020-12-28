<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Criar Playgroup</title>
        <script src="/ckeditor/ckeditor.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>Criar Playgroup</h1>
<?php
    if(isset($message)) { echo '<p role="alert">' .$message. '</p>'; };
?> 
        <div id="createGroupForm">
            <form method="post" action="<?=BASE_PATH?>groupinteract/creategroup/<?=$secondAction?>">
                <div>
                    <label>
                        Nome do Playgroup
                        <input type="text" name="group_name" minlength="2" maxlength="64"required autofocus>
                    </label>
                </div>
                <div>
                    <label>
                        Descrição
                        <textarea name="description" cols="30" rows="10" id="myeditor" required></textarea>
                    </label>
                </div>
                <div>
                    <label>
                        Nome do Jogo
                        <input type="text" name="game_name" required>
                    </label>
                </div>
                <div>
                    <label>
                        Data e Hora do Playgroup
                        <input type="datetime-local" name="group_date" required>
                    </label>
                </div>
                <div>
                    <label>
                        Duração do jogo(estimativa em minutos)
                        <input type="number" name="group_duration" required >
                    </label>
                </div>
                <div>
                    <label>
                        Nº de jogadores
                        <input type="number" name="total_players" required>
                    </label>
                </div>
                <div>
                <button type="submit" name="send">Criar</button>
                </div>
            </form>
        <a href="<?=BASE_PATH?>groups">Cancelar</a>
        <script src="/scripts/ckeditorscript.js"></script>
    </body>
</html>