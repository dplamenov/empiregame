<?php

namespace system\Service;


use system\DTO\UserDTO;
use system\Repository\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($username, $password)
    {
        /**
         * @var $user UserDTO
         */
        $user = $this->userRepository->check($username);
        /**
         * if (!password_verify($user->getPass(), $password)) {
            throw new \Exception('Wrong username or password');
        }

         */

        return $user;
    }
}