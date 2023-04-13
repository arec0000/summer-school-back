<?php

namespace App\Services\User;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//require '../../backend/vendor/autoload.php';
class SendMailService
{
    public function __construct()
    {
    }

//    public function send($user, $password)
    public function send($user)
    {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'ssl://smtp.yandex.ru';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'Sumerschool@yandex.ru';
        $mail->Password = 'jubglbiqkfihapno';
        $mail->setFrom('Sumerschool@yandex.ru', 'Sumer School');
        $mail->addAddress($user);
//        $mail->Subject = 'Reset Password';
//        $mail->Body = 'Новый пароль:  ' . $password;
        $mail->Subject = 'Registration to Summer School';
        $mail->Body = 'Вы зарегистрировались на сайте Летней школы, благодарим вас за присоединению к нашему проекту и надеемся что вы будете довольны результатом нашей работы.';

        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
     }
}