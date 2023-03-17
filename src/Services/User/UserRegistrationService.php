<?php

namespace App\Services\User;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserRegistrationService
{
    public function __construct(
        private UserPasswordHasherInterface $hasher)
    {

    }

    public function hashPassword( PasswordAuthenticatedUserInterface $user, string $password): string
    {
        return  $this->hasher->hashPassword($user, $password);
    }
}