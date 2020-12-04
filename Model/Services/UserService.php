<?php


namespace Model\Services;
use Controller\UserController;
use Model\Repository\UserRepository;

class UserService
{
    public function saveUser($username, $email, $password)
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
        }
        //COOKIE
        $cookieName = 'MyUserId';
        $date = time() + (60*60*24*7*2);
        setcookie($cookieName, $userId, $date);

        return $result;
    }

    public function getUser($userId)
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

    public function getAllUsers()
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
}