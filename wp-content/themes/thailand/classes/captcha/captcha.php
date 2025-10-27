<?php

session_start();
require_once __DIR__ . '/CaptchaCls.php';
require_once __DIR__ . '/ImageCls.php';


// ✅ 如果是前端用 AJAX 來取文字驗證碼
if (isset($_GET['getCode']) && $_GET['getCode'] === 'true') {
    echo isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';
    exit;
}

// ✅ 是否重置
$reset = isset($_GET['reset']) && $_GET['reset'] === 'true';

// ✅ 生成 Captcha
$objCaptcha = new CaptchaCls(5, $reset);
$strCaptcha = $objCaptcha->getCaptcha();

// ✅ 顯示圖像
$fontPath = __DIR__ . '/Vnitruck.TTF';
$objImage = new ImageCls(200, 50, $strCaptcha);
$objImage->showImage($fontPath);


