<?php
declare(strict_types=1);
namespace MyApp\Services;
use MyApp\User;

class AuthService {
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function register(string $username, string $firstname, string $lastname, string $email, string $phone, string $password, string $address): bool|string {
        return $this->user->registerUser($username, $firstname, $lastname, $email, $phone, $password, $address);
    }

    public function login(string $username, string $password): bool|string {
        return $this->user->loginUser($username, $password);
    }
    public function logout() {
        return $this->user->logout();
    }
}

