<?php

namespace App;

use PDO;
use PDOException;
class User {
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

    public function removeAllUsers(): bool
    {
        $stmt = $this->connect->prepare("DELETE FROM users");
        if ($stmt === false) {
            return false;
        }
        if ($stmt->execute() === false) {
            return false;
        }
        return $stmt->fetch() !== false;
    }
}