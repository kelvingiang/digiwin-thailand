<?php
class CaptchaCls
{
    private  $_intCaptchaLength;
    private  $_strCaptcha = '';

    /**
     * 建立 Captcha 物件
     * @param int $length 驗證碼長度
     * @param bool $reset 是否重建新驗證碼
     */
    public function __construct(int $length = 5, bool $reset = true)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($reset) {
            $this->_intCaptchaLength = $length;
            $this->_generateCaptcha();
        } else {
            $this->_strCaptcha = $_SESSION['captcha'] ?? '';
        }
    }

    /**
     * 產生新的驗證碼
     */
    private function _generateCaptcha(): void
    {
        $chars = '23456789abcdefghjkmnpqrstuvwxyz';
        $this->_strCaptcha = '';

        for ($i = 0; $i < $this->_intCaptchaLength; $i++) {
            $this->_strCaptcha .= $chars[random_int(0, strlen($chars) - 1)];
        }

        $_SESSION['captcha'] = $this->_strCaptcha;
    }

    /**
     * 取得驗證碼字串
     */
    public function getCaptcha(): string
    {
        return $this->_strCaptcha;
    }

    /**
     * 允許直接 echo 輸出物件
     */
    public function __toString(): string
    {
        return $this->_strCaptcha;
    }
}
