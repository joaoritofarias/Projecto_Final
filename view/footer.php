<footer>
<?php
    if(isset($_SESSION["user_id"]) || isset($_SESSION["store_id"]) ) {
?>
        <a href="<?=BASE_PATH?>access/logout">>Logout<</a>
        <a href="<?=BASE_PATH?>profileinteract/delete">>Apagar a minha conta<</a>
<?php
    }
?>
</footer>