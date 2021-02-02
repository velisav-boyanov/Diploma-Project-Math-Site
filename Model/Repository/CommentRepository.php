<?php

namespace Model\Repository;
use Model\Repository\DBManager;

class CommentRepository
{
    public function saveComment($commentToInsert): string
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `Message` (`User_Id`, `Username`, `Message`, `Post_Id`)
               VALUES (:UserId, :Username, :Message, :PostId)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($commentToInsert);
        return $pdo->lastInsertId();
    }

    public function getCommentById($commentId)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `Message` 
                WHERE `Id` = :commentId';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['commentId' => $commentId]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getCommentByPostId($postId)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `Message` 
                WHERE `Post_Id` = :postId';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['postId' => $postId]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getCommentByParentCommentId($commentId)
    {
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `Message` 
                WHERE `Parrent_Comment_Id` = :commentId';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['commentId' => $commentId]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}