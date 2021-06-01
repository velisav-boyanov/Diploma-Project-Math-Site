<?php

namespace Model\Repository;

class TestRepository
{
    public function saveTest($test): string
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `Test` (`User_Id`, `Exercises`)
               VALUES (:UserId, :Exercises)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($test);
        return $pdo->lastInsertId();
    }

    public function getById($testId): array
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Exercises` FROM `Test`
                WHERE `Id` = :Id';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['Id' => $testId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}