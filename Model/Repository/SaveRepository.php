<?php

namespace Model\Repository;


class SaveRepository
{
    public function saveTriangle($triangleToInsert)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `Saved_Triangles` (`Type`, `Given`, `SolvingText`, `Parameters`, `User_Id`)
               VALUES (:Type, :Given, :SolvingText, :Parameters, :UserId)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($triangleToInsert);
        return $pdo->lastInsertId();
    }

    public function getTriangleById($triangleId)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `Saved_Triangles` 
                WHERE `id` = :triangleId';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['triangleId' => $triangleId]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTriangleByUserId($userId)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `Saved_Triangles`
                WHERE `User_Id` = :userId';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}