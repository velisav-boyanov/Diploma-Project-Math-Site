<?php


namespace Model\Services;


use Model\Repository\TestRepository;

class TestService
{
    public function saveTest($userId, $exercises): array
    {
        $result = ['success' => false];

        $repo = new TestRepository();

        $userToInsert = [
            'UserId' => $userId,
            'Exercises' => $exercises
        ];

        if($testId = $repo->saveTest($userToInsert))
        {
            $result['success'] = true;
            $result['msg'] = 'Test successfully added!';
            $result['id'] = $testId;
        }

        return $result;
    }

    public function getById($testId)
    {
        $repo = new TestRepository();
        return $result = $repo->getById($testId);
    }
}