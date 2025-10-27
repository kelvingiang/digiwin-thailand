<?php
class ImageCls
{
    private $width;
    private $height;
    private $captcha;

    public function __construct($width, $height, $captcha)
    {
        $this->width = $width;
        $this->height = $height;
        $this->captcha = $captcha;
    }

    public function showImage($fontFile)
    {
        // 建立圖片
        $image = imagecreatetruecolor($this->width, $this->height);

        // 隨機背景顏色（偏亮）
        $bgColor = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
        imagefill($image, 0, 0, $bgColor);

        // 干擾線 + 雜點顏色
        for ($i = 0; $i < 5; $i++) {
            $lineColor = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
            imageline($image, 0, rand(0, $this->height), $this->width, rand(0, $this->height), $lineColor);
        }

        for ($i = 0; $i < 200; $i++) {
            $dotColor = imagecolorallocate($image, rand(150, 255), rand(150, 255), rand(150, 255));
            imagesetpixel($image, rand(0, $this->width), rand(0, $this->height), $dotColor);
        }

        // 寫字（每個字不同顏色）
        $x = 20;
        $fontSize = 24;

        for ($i = 0; $i < strlen($this->captcha); $i++) {
            $angle = rand(-15, 15);
            $textColor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
            imagettftext($image, $fontSize, $angle, $x, rand(30, 40), $textColor, $fontFile, $this->captcha[$i]);
            $x += 30; // 每個字間距
        }

        // 輸出圖片
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
}
