<?php

namespace Model\Repository;


class SaveRepository
{
    public function saveTriangle($triangleToInsert): string
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `Saved_Triangles` (`Type`, `Given`, `SolvingText`, `Parameters`, `User_Id`, `Is_Blog`)
               VALUES (:Type, :Given, :SolvingText, :Parameters, :UserId, :IsBlog)';

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

    public function getTriangleByUserId($userId): array
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `Saved_Triangles`
                WHERE `User_Id` = :userId';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userId' => $userId['Id'] ?? $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getBlogs(): array
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `Saved_Triangles`
                WHERE `Is_Blog` = :blog';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['blog' => 1]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function removePost($postId)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'DELETE FROM `Saved_Triangles` 
                WHERE `Saved_Triangles`.`Id` = :postId';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['postId' => $postId]);
    }
}