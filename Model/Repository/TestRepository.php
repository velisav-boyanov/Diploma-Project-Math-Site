<?php

namespace Model\Repository;

class TestRepository
{
    public function saveTest($test): string
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `Tests` (`User_Id`, `Exercises`)
               VALUES (:UserId, :Exercises)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($test);
        return $pdo->lastInsertId();
    }
}