<?php


namespace Model\Services;
use Model\Repository\SaveRepository;

class SaveService
{
    public function saveTriangle($type, $given, $solvingText, $parameters, $userId)
    {
        $result = ['success' => false];

        $repo = new SaveRepository();

        $triangleToInsert = [
            'Type' => $type,
            'Given' => $given,
            'SolvingText' => $solvingText,
            'Parameters' => $parameters,
            'UserId' => $userId['Id']
        ];

        if($userId = $repo->saveTriangle($triangleToInsert))
        {
            $result['success'] = true;
            $result['msg'] = 'Triangle successfully added!';
            $result['id'] = $userId;
        }

        return $result;
    }

    public function getTriangle($triangleId)
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

    public function getTriangleByUserId($userId){
        $repo = new SaveRepository();
        return $repo->getTriangleByUserId($userId);
    }
}