<?php

namespace App;

use PDO;
use PDOException;
class Auth {

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

    public function isUserCreated(string $email): bool
    {
        $stmt = $this->connect->prepare("select id from users where email = :email and is_confirm = 1");
        if ($stmt === false) {
            return false;
        }
        if ($stmt->execute(['email' => $email]) === false) {
            return false;
        }
        return $stmt->fetch() !== false;
    }

    public function getUserByLogin(string $email)
    {
        $stmt = $this->connect->prepare("select * from users where email = :email limit 1");
        if ($stmt === false) {
            return false;
        }
        if ($stmt->execute(['email' => $email]) === false) {
            return false;
        }
        return $stmt->fetch();
    }
}