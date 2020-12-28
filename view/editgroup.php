<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Edite o seu Playgroup</title>
        <script src="/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <h1>Edite o seu Playgroup</h1>
<?php
    if(isset($message)) { echo '<p role="alert">' .$message. '</p>'; };
?> 
        <div id="editGroupForm">
            <form method="post" action="<?=BASE_PATH?>groupinteract/editgroup/<?=$secondAction?>">
                <div>
                    <label>
                        Nome do Playgroup
                        <input type="text" name="group_name" minlength="2" maxlength="64" >
                    </label>
                </div>
                <div>
                    <label>
                        Descrição
                        <textarea name="description" id="myeditor" cols="30" rows="10"></textarea>
                    </label>
                </div>
                <div>
                    <label>
                        Nome do Jogo
                        <input type="text" name="game_name">
                    </label>
                </div>
                <div>
                    <label>
                        Data e Hora do Playgroup
                        <input type="datetime-local" name="group_date">
                    </label>
                </div>
                <div>
                    <label>
                        Duração do jogo(estimativa em minutos)
                        <input type="number" name="group_duration">
                    </label>
                </div>
                <div>
                    <label>
                        Nº de jogadores
                        <input type="number" name="total_players">
                    </label>
                </div>
                <div>
                <button type="submit" name="send">Actualizar</button>
                </div>
            </form>
        <a href="<?=BASE_PATH?>groups">Cancelar</a>
        <script src="/scripts/ckeditorscript.js"></script>
    </body>
</html>