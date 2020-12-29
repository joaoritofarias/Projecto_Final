<?php
    session_start();

    $randomStr = md5(rand(10000, 99999));

    $captchaCode = substr($randomStr, 0, 7);

    $_SESSION["captcha"] = $captchaCode;

    header("Content-Type: image/png");

    $image = imagecreatetruecolor(200, 50);

    $backgroundColor = imagecolorallocate($image, 102, 0, 204);

    $textColor = imagecolorallocate($image, 0, 0, 0);

    imagefilledrectangle($image, 5, 5, 195, 45, $backgroundColor);

    $font = __DIR__."/PIXEAB__.ttf";

    imagettftext($image, 20, 0, 25, 40, $textColor, $font, $captchaCode);

    imagepng($image);

    imagedestroy($image);  
?>