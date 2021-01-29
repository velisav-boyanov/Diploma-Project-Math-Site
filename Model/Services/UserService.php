<?php


namespace Model\Services;
use Controller\UserController;
use Model\Repository\UserRepository;

class UserService
{
    public function saveUser($username, $email, $password): array
    {
        $result = ['success' => false];

        $repo = new UserRepository();

        $userToInsert = [
            'Username' => $username,
            'Email' => $email,
            'Password' => $password
        ];

        //$playerId = $repo->savePlayer($playerToInsert);
        if($userId = $repo->saveUser($userToInsert))
        {
            $result['success'] = true;
            $result['msg'] = 'User successfully added!';
            $result['id'] = $userId;
        }

        return $result;
    }

    public function getUser($userId): array
    {
        $result = [
            'success' => false
        ];

        $repo = new UserRepository();
        $user = $repo->getUserById($userId);

        if (!$user) {
            $result['msg'] = 'User with id ' . $userId . ' was not found!';
            return $result;
        }

        $result['success'] = true;
        $result['user'] = $user;
        return $result;
    }

    public function getUserByNameAndPassword($userName, $userPassword): array
    {
        $result = [
            'success' => false
        ];

        $repo = new UserRepository();
        $user = $repo->getUserByNameAndPassword($userName, $userPassword);

        if(!$user){
            return $result;
        }

        $result['id'] = $user;
        $result['success'] = true;
        return $result;
    }

    public function getAllUsers(): array
    {
        $result = [
            'success' => false
        ];

        $repo = new UserRepository();
        $user = $repo->getAllUsers();

        if (!$user) {
            $result['msg'] = 'There are no users yet!';
            return $result;
        }

        $result['success'] = true;
        $result['user'] = $user;
        return $result;
    }

    public function getUserByName($userName): array
    {
        $result = [
            'success' => false
        ];

        $repo = new UserRepository();
        $user = $repo->getUserByName($userName);

        if(!$user){
            return $result;
        }

        $result['success'] = true;
        return $result;
    }
}
