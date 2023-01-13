<?php

namespace App;

use PDO;
use PDOException;
use Symfony\Component\HttpFoundation\Request;

class Offer
{
    private PDO $connect;

    public function __construct(array $config)
    {
        try {
            $this->connect = new PDO(
                'mysql:host=' . $config['db']['host'] . ";dbname="
                . $config['db']['dbname'] . ";charset=utf8",
                $config['db']['user'],
                $config['db']['password']
            );
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }

    public function addOffer(string $id, string $user_id): bool
    {
        $stmt = $this->connect->prepare("INSERT INTO `request_offers` (`user_id`, `credits_id`, `create_date`) VALUES
(:user_id, :credits_id, :create_date)");
        if ($stmt === false) {
            return false;
        }
        $stmt->execute([
            'user_id' => $user_id,
            'credits_id' => $id,
            'create_date' => date('Y-m-d h:i:s'),
        ]);
        if ($stmt === false) {
            return false;
        }
        return $stmt->errorCode() === "00000";
    }
}