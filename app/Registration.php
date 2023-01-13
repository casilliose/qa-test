<?php

namespace App;

use PDO;
use PDOException;
use Symfony\Component\HttpFoundation\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Registration {

    private PDO $connect;

    public function __construct(array $config)
    {
        try {
            $this->connect = new PDO('mysql:host=' . $config['db']['host'].";dbname=".$config['db']['dbname'].";charset=utf8",
                $config['db']['user'],
                $config['db']['password']
            );
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }

    public function checkDoubleUser(string $email): bool
    {
        $stmt = $this->connect->prepare("select id from users where email = :email");
        if ($stmt === false) {
            return false;
        }
        if ($stmt->execute(['email' => $email]) === false) {
            return false;
        }
        return $stmt->fetch() !== false;
    }

    public function createUser(Request $request): bool
    {
        $stmt = $this->connect->prepare("INSERT INTO `users` (`name`, `lastname`, `email`, `birthday`, `is_confirm`, `password`, `hash_approve`) VALUES
(:name,	:lastname, :email, :birthday, :is_confirm, '', '')");
        if ($stmt === false) {
            return false;
        }
        $stmt->execute([
            'email' => $request->get("email"),
            'name' => $request->get("name"),
            'lastname' => $request->get("lastname"),
            'birthday' => $request->get("birthday-year").'-'.$request->get("birthday-month").'-'.$request->get("birthday-day"),
            'is_confirm' => 0
        ]);
        if ($stmt === false) {
            return false;
        }
        return $stmt->errorCode() === "00000";
    }

    public function sendApproveEmail(string $email): bool
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $password = substr(str_shuffle($permitted_chars), 0, 10);
        $stmt = $this->connect->prepare("UPDATE `users` SET `hash_approve` = :hash_approve WHERE email = :email");
        $stmt->execute(['hash_approve' => $password, 'email' => $email]);
        if ($stmt === false) {
            return false;
        }
        if ($stmt->errorCode() === "00000") {
            $mail = new PHPMailer(true);
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
                $eb = base64_encode($email);
                $mail->addAddress($email);
                $link = "http://localhost:9100/password-create/$password/$eb/";
                $mail->Subject = 'MyFinTest подтверждение email при регистрации';
                $mail->Body    = "Ссылка на подтверждение email $link";
                return $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        return false;
    }

    public function checkUserIsNotPassword(string $email, string $pass_aprove): bool
    {
        $stmt = $this->connect->prepare("select id from users where email = :email and is_confirm = 0 and hash_approve = :hash_approve");
        if ($stmt === false) {
            return false;
        }
        if ($stmt->execute(['email' => $email, "hash_approve" => $pass_aprove]) === false) {
            return false;
        }
        return $stmt->errorCode() === "00000";
    }

    public function savePassword(string $password, string $email, string $pass_aprove): bool
    {
        $stmt = $this->connect->prepare("UPDATE `users` SET `password` = :password, `is_confirm` = 1 WHERE email = :email and hash_approve = :hash_approve");
        $stmt->execute(['password' => $password, 'email' => $email, 'hash_approve' => $pass_aprove]);
        if ($stmt === false) {
            return false;
        }
        return $stmt->errorCode() === "00000";
    }
}