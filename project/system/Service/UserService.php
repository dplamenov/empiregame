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
        try {
            $user = $this->userRepository->check($username);
        } catch (\Exception $exception) {
            throw new \Exception('Wrong username or password');
        }
        if (!password_verify($password, $user->getPass())) {
            throw new \Exception('Wrong username or password');
        }

        return $user;
    }

    public function register(UserDTO $userDTO, $confirm_password)
    {
        if ($userDTO->getPass() == $confirm_password) {
            $userDTO->setPass(password_hash($userDTO->getPass(), PASSWORD_BCRYPT));
            return $this->userRepository->insert($userDTO);
        }
        throw new \Exception('Confirm password must be matched password');

    }

    public function findById(int $user_id): UserDTO
    {
        return $this->userRepository->getOne($user_id);
    }

    public function findByUsername(string $username): UserDTO
    {
        return $this->userRepository->getOneByUsername($username);
    }
}