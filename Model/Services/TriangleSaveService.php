<?php


namespace Model\Services;
use Model\Repository\TriangleSaveRepository;

class TriangleSaveService
{
    public function saveTriangle($given, $solvingText, $parameters, $userId)
    {
        $result = ['success' => false];

        $repo = new TriangleSaveRepository();

        $triangleToInsert = [
            'Given' => $given,
            'SolvingText' => $solvingText,
            'Parameters' => $parameters,
            'UserId' => $userId
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

        $repo = new TriangleSaveRepository();
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
        $result = [
            'success' => false
        ];

        $repo = new TriangleSaveRepository();
        $triangle = $repo->getTriangleByUserId($userId);

        if(!$triangle){
            return $result;
        }

        $result['success'] = true;
        return $result;
    }
}