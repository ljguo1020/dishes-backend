<?php

namespace app\utils;

use app\enum\EmailTemplate;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class SendEmail {


    private $from;
    private $username;
    private $password;
    private $mail;

    public function __construct()
    {
        $this->from = env('EMAIL');
        $this->username = env('EMAIL_USER_NAME');
        $this->password = env('EMAIL_PASS');
        $this->initialization();
    }

    private function initialization() {
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.qq.com';  // SMTP 服务器地址
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->from;  // SMTP 用户名
        $this->mail->Password = $this->password;  // SMTP 密码
        $this->mail->SMTPSecure = 'tls';  // 加密方式，可以是 tls 或 ssl
        $this->mail->Port = 25;  // SMTP 端口号
        $this->mail->CharSet = 'UTF-8';

        $this->mail->setFrom($this->from, $this->username);  // 发件人邮箱和名称

        // 邮件内容
        $this->mail->isHTML(true);  // 设置邮件内容为 HTML 格式
    }

    public function send(string $to, EmailTemplate $tpl, \Closure $closure) {
        // 收件人设置
        $this->mail->addAddress($to, '');
   
        $contnet = file_get_contents(app()->getRootPath() . "/template/{$tpl->value}.tpl");

        // 主题
        $this->mail->Subject = '《欣语心愿》';

        // 回调函数处理内容
        $message = $closure();

        // 内容
        $this->mail->Body = str_replace('{{ message }}', $message, $contnet);
    
        // 发送邮件
        $this->mail->send();

    }
}



