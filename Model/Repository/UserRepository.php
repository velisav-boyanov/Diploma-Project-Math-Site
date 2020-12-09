<?php

namespace Model\Repository;

use Controller\UserController;

class UserRepository
{
    public function saveUser($userToInsert)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `User` (`Username`, `Email`, `Password`)
               VALUES (:Username, :Email, :Password)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($userToInsert);
        return $pdo->lastInsertId();
    }

    public function getUserById($userId)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `User` 
                WHERE `id` = :userId';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userId' => $userId]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserByNameAndPassword($userName, $userPassword)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT Id FROM `User` 
                WHERE (`Username` = :userName OR `Email` = :userName) AND `Password` = :userPassword';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userName' => $userName, 'userPassword' => $userPassword]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllUsers()
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `User`';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUserByName($userName)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT Id FROM `User` 
                WHERE `Username` = :userName OR `Email` = :userName';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userName' => $userName]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

}
