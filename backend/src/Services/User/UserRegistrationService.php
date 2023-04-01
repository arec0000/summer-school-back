<?php

namespace App\Services\User;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserRegistrationService
{
    public function __construct(
        private  UserPasswordHasherInterface $hashed )
    {

    }


    public function hashPassword( PasswordAuthenticatedUserInterface $user, string $password): string
    {
        return  $this->hashed->hashPassword($user, $password);
    }
}