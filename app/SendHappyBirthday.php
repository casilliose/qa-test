<?php

require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {
    $config = include "config.php";
    $connect = new PDO(
        'mysql:host=' . $config['db']['host'] . ";dbname="
        . $config['db']['dbname'] . ";charset=utf8",
        $config['db']['user'],
        $config['db']['password']
    );
    $stmt = $connect->prepare("select * from users where birthday = :birthday");
    if ($stmt === false) {
        return false;
    }
    if ($stmt->execute(['birthday' => date('Y-m-d')]) === false) {
        return false;
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $mail = new PHPMailer(true);
    foreach ($result as $value) {
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.mail.ru';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'myfintest@mail.ru';                     //SMTP username
            $mail->Password   = '0AXZNVnFBWf37mdj3ZkV';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom("myfintest@mail.ru", 'MyFinTest');
            $mail->addAddress($value['email']);
            $mail->Subject = 'MyFinTest поздравляет вас с днем рождения !!!';
            $mail->Body    = "С днем рождения {$value['name']} {$value['lastname']} всего всего самого наилучшего !!!";
            echo "На email {$value['email']} отправка = " . $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}