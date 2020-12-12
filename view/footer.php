<footer>
<?php
    if(isset($_SESSION["user_id"])) {
?>
        <a href="<?=BASE_PATH?>access/logout">Logout</a>
<?php
    }
?>
</footer>