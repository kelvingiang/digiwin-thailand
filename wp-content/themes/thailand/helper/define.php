<?php
define('DIR_CONTROLLER', THEME_URL . DS . 'controllers' . DS);
define('DIR_MODEL', THEME_URL . DS . 'models' . DS);
define('DIR_META_BOX', THEME_URL . DS . 'meta-box' . DS);
define('DIR_TAXONOMY', THEME_URL . DS . 'taxonomy' . DS);
define('DIR_VIEW', THEME_URL . DS . 'views' . DS);
define('DIR_CODE', THEME_URL . DS . 'codes' . DS);

define('DIR_CLASSES', THEME_URL . DS . 'classes' . DS);
define('DIR_FONTS', THEME_URL . DS . 'fonts' . DS);
define('DIR_FILE', THEME_URL . DS . 'file' . DS);
define('DIR_AJAX', THEME_URL . DS . 'ajax' . DS);
define('DIR_IMAGES', THEME_URL . DS . 'images' . DS);

/* === PART TRUC TIEP  ====== */
define('PART_IMAGES', THEME_PART . '/images/');
define('PART_ICON', PART_IMAGES . '/icon/');
define('PART_IMAGES_GUESTS', PART_IMAGES . '/guests/');
define('PART_FILE', THEME_PART . '/file/');
define('PART_CLASS', THEME_PART . '/classes/');
define('PART_AJAX', THEME_PART . '/ajax/');


/** SMTP 配置 (為了增強 Email 發送可靠性) */
define('SMTP_HOST', 'smtp.gmail.com');  // <-- 替換成您的 SMTP 伺服器
define('SMTP_PORT', 587);                      // <-- 替換成您的 Port (例如 587 或 465)
define('SMTP_SECURE', 'tls');                  // <-- 替換成 'tls' 或 'ssl'
define('SMTP_AUTH', true);                     // 啟用驗證
define('SMTP_USERNAME', 'kelvinctcvn@gmail.com'); // <-- 替換成您的 SMTP 使用者名稱/信箱
define('SMTP_PASSWORD', 'yidgmjjlepprajbn');  // <-- 替換成您的 SMTP 密碼
define('SMTP_FROM_EMAIL', 'kelvinctcvn@gmail.com'); // 網站發送郵件的 From 地址
define('SMTP_FROM_NAME', 'Your Website Name');       // 網站發送郵件的 From 名稱
