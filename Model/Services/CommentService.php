<?php


namespace Model\Services;
use Model\Repository\CommentRepository;

class CommentService
{
    public function saveComment($userId, $postId, $username, $message): array
    {
        $result = ['success' => false];

        $repo = new CommentRepository();

        $commentToInsert = [
            'UserId' => $userId,
            'Username' => $username,
            'Message' => $message,
            'PostId' => $postId
        ];

        //$playerId = $repo->savePlayer($playerToInsert);
        if($commentId = $repo->saveComment($commentToInsert))
        {
            $result['success'] = true;
            $result['msg'] = 'Comment successfully added!';
            $result['id'] = $commentId;
        }

        return $result;
    }

    public function getComment($commentId): array
    {
        $repo = new CommentRepository();
        $cmt = $repo->getCommentById($commentId);

        if (!$cmt) {
            $result['msg'] = 'User with id ' . $commentId . ' was not found!';
            return $result;
        }

        $result['success'] = true;
        $result['comment'] = $cmt;
        return $result;
    }


    public function getCommentByPostId($postId): array
    {
        $repo = new CommentRepository();
        $cmt = $repo->getCommentByPostId($postId);

        if (!$cmt) {
            $result['msg'] = 'User with id ' . $postId . ' was not found!';
            return $result;
        }

        $result['success'] = true;
        $result['comment'] = $cmt;
        return $result;
    }

    public function getCommentByParentCommentId($commentId): array
    {
        $repo = new CommentRepository();
        $cmt = $repo->getCommentByParentCommentId($commentId);

        if (!$cmt) {
            $result['msg'] = 'User with id ' . $commentId . ' was not found!';
            return $result;
        }

        $result['success'] = true;
        $result['comment'] = $cmt;
        return $result;
    }
}