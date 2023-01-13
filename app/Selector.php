<?php

namespace App;

use PDO;
use PDOException;
use Symfony\Component\HttpFoundation\Request;

class Selector
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

    public function getResultByFilter(Request $request): array
    {
        if ($request->get('amount') > 1000000) {
            $stmt = $this->connect->prepare(
                "select * from credits"
            );
        } else {
            $stmt = $this->connect->prepare(
                "select * from credits 
                    where min_amount <= :amount and max_amount >= :amount 
                    and min_term <= :term and max_term >= :term
                    and target = :target and real_estate = :real_estate and have_car = :have_car"
            );
        }
        if ($stmt === false) {
            return false;
        }
        if ($stmt->execute([
            'amount' => $request->get("amount"),
            "term" => $request->get("term"),
            "target" => $request->get("target"),
            "history" => $request->get("history"),
            "real_estate" => $request->get("real_estate"),
            "have_car" => 1,
        ]) === false) {
            return false;
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($request->get('amount') >= 1000 && $request->get('amount') <= 10000) {
            $id = random_int(1, 31);
            $id2 = random_int(1, 31);
            if (($randResult = $this->connect->query("select * from credits where id = $id or id = $id2"))) {
                $result = array_merge($result, $randResult->fetchAll(PDO::FETCH_ASSOC));
            }
        }
        return $result;
    }
}