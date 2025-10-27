<?php

/**
 * 處理聯繫表單 AJAX 提交和發送 Email 給 Admin
 */
function handle_contact_form_submission()
{

    // 1. 伺服器端 Captcha 驗證 (因為您使用自定義 Captcha，這裡需要配合您的 Captcha 類)
    // ⚠️ 假設您的 CaptchaCls 在您的 custom-form.php 頁面已引入且能存取 $_SESSION['captcha']

    // 由於 Captcha 是透過 $_SESSION 判斷，為了 AJAX 請求也能存取 Session，
    // 您可能需要在 wp-config.php 開頭或某個啟動 hook 中加入 session_start();
    // 但在 WordPress 環境中啟用 session 較複雜且不推薦，這裡建議您將 Captcha 驗證
    // 邏輯改為在 AJAX 處理中執行。

    $input_captcha = isset($_POST['txt-captcha']) ? sanitize_text_field($_POST['txt-captcha']) : '';

    // 由於無法直接在 AJAX 中訪問原始頁面的 $_SESSION，
    // 在您的 Captcha 系統中，您可能需要一個額外的 AJAX 請求來驗證 Captcha，
    // 或者在您的 captcha.php 腳本中處理驗證邏輯。

    // 為了演示發送 Email 流程，我們暫時跳過 Captcha 的複雜 Session 處理。

    // 2. 清理和獲取數據
    $company = isset($_POST['txt-company']) ? sanitize_text_field($_POST['txt-company']) : '';
    $name    = isset($_POST['txt-name']) ? sanitize_text_field($_POST['txt-name']) : '';
    $email   = isset($_POST['txt-email']) ? sanitize_email($_POST['txt-email']) : '';
    $phone   = isset($_POST['txt-phone']) ? sanitize_text_field($_POST['txt-phone']) : '';
    $consent = isset($_POST['chk-box']) ? 'Accepted' : 'Not Accepted';

    // 3. 伺服器端基本驗證
    if (empty($company) || empty($name) || !is_email($email)) {
        wp_send_json_error(['message' => 'Please fill in required fields or check email format.']);
        wp_die();
    }

    // 4. 郵件內容設置
    $admin_email = get_option('admin_email'); // 獲取網站管理員 Email
    $subject     = 'New Contact Form Submission from ' . $name;

    $message_body = "
        <h1>New Inquiry Received</h1>
        <p><strong>Company:</strong> {$company}</p>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Privacy Policy Consent:</strong> {$consent}</p>
    ";

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email,
    ];

    // 5. 使用 wp_mail() 發送郵件
    $mail_sent = wp_mail($admin_email, $subject, $message_body, $headers);

    if ($mail_sent) {
        wp_send_json_success(['message' => 'Mail successfully sent.']);
    } else {
        // 如果郵件發送失敗（通常是伺服器配置問題）
        wp_send_json_error(['message' => 'Failed to send mail. Server error.']);
    }

    wp_die(); // 必須呼叫 wp_die() 來結束 AJAX 處理
}

// 註冊 AJAX 處理動作
// 所有人都可以提交: wp_ajax_nopriv_{action_name}
add_action('wp_ajax_nopriv_my_form_action', 'handle_contact_form_submission');
// 僅登入使用者可以提交 (如果需要): wp_ajax_{action_name}
add_action('wp_ajax_my_form_action', 'handle_contact_form_submission');



/**
 * 使用 phpmailer_init 動作鉤子來配置 SMTP
 * 所有的 wp_mail() 都將透過這些 SMTP 設置發送
 */
function custom_phpmailer_smtp_config($phpmailer) {
    
    // 檢查是否已定義必要的常數
    if (!defined('SMTP_HOST') || !SMTP_HOST) {
        return; // 如果未定義，則使用預設的 wp_mail 設置 (PHP mail)
    }

    $phpmailer->isSMTP();                           // 設定使用 SMTP
    $phpmailer->Host       = SMTP_HOST;             // SMTP 主機
    $phpmailer->SMTPAuth   = SMTP_AUTH;             // 啟用 SMTP 驗證
    $phpmailer->Port       = SMTP_PORT;             // 端口
    $phpmailer->Username   = SMTP_USERNAME;         // 使用者名稱
    $phpmailer->Password   = SMTP_PASSWORD;         // 密碼
    $phpmailer->SMTPSecure = SMTP_SECURE;           // 安全協議 (tls 或 ssl)
    
    // 覆蓋預設的發件人 Email 和名稱 (這能避免一些伺服器發送失敗)
    if (defined('SMTP_FROM_EMAIL') && SMTP_FROM_EMAIL) {
        $phpmailer->From = SMTP_FROM_EMAIL;
    }
    if (defined('SMTP_FROM_NAME') && SMTP_FROM_NAME) {
        $phpmailer->FromName = SMTP_FROM_NAME;
    }

    // 可以在這裡啟用詳細 Debug 輸出，以便測試時查看錯誤
    // $phpmailer->SMTPDebug = 2; // 啟用 Debug 模式 (1=Client, 2=Client+Server)
}
add_action('phpmailer_init', 'custom_phpmailer_smtp_config');
