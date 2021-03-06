<?php


namespace Model\Services;
use Model\Repository\SaveRepository;

class SaveService
{
    public function saveTriangle($type, $given, $solvingText, $parameters, $userId, $isBlog): array
    {
        $result = ['success' => false];

        $repo = new SaveRepository();

        $triangleToInsert = [
            'Type' => $type,
            'Given' => $given,
            'SolvingText' => $solvingText,
            'Parameters' => $parameters,
            'UserId' => $userId['Id'] ?? $userId,
            'IsBlog' => $isBlog
        ];

        if($userId = $repo->saveTriangle($triangleToInsert))
        {
            $result['success'] = true;
            $result['msg'] = 'Triangle successfully added!';
            $result['id'] = $userId;
        }

        return $result;
    }

    public function getOldTests($userId){
        $repo = new SaveRepository();

        $saveIds = $repo->getOldTests($userId);

        for($i = 0; $i < sizeof($saveIds); $i++){
            $saveIds[$i] = $saveIds[$i]['Id'];
        }

        return $saveIds;
    }

    public function getTriangle($triangleId): array
    {
        $result = [
            'success' => false
        ];

        $repo = new SaveRepository();
        $triangle = $repo->getTriangleById($triangleId);

        if (!$triangle) {
            $result['msg'] = 'Save with id ' . $triangleId . ' was not found!';
            return $result;
        }

        $result['success'] = true;
        $result['triangle'] = $triangle;
        return $result;
    }

    public function removePost($postId)
    {
        $repo = new SaveRepository();
        $repo->removePost($postId);
    }

    public function markAsAdded($postId, $isAdded)
    {
        $repo = new SaveRepository();
        $repo->markAsAdded($postId, $isAdded);
    }

    public function getTriangleByUserId($userId): array
    {
        $repo = new SaveRepository();
        return $repo->getTriangleByUserId($userId);
    }

    public function getBlogs(): array
    {
        $repo = new SaveRepository();
        return $repo->getBlogs();
    }

    public function cleanOldTests()
    {
        $repo = new SaveRepository();
        return $repo->clean();
    }
}