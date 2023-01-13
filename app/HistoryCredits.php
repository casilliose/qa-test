<?php

namespace App;

use PDO;
use PDOException;
use Symfony\Component\HttpFoundation\Request;

class HistoryCredits
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

    public function getHistoryByUser(string $user_id): array
    {
        $stmt = $this->connect->prepare(
            "select * from request_offers
left join credits on 
request_offers.credits_id = credits.id
where user_id = :user_id and DATE(create_date) = :date_now"
        );
        if ($stmt === false) {
            return false;
        }
        if ($stmt->execute([
                'user_id'      => $user_id,
                'date_now' => date('Y-m-d')
            ]) === false
        ) {
            return false;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}