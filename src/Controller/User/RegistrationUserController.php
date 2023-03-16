<?php

namespace App\Controller\User;

use ApiPlatform\Symfony\Validator\Validator;
use ApiPlatform\Validator\ValidatorInterface;
use App\Entity\User\User;
use App\Services\User\UserRegistrationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationUserController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator,
        private UserRegistrationService $userRegistrationService
    )
    {}
    public function __invoke(User $user, Request $request,ValidatorInterface $validator): Void
    {
        //это магический метод, но чем-то схож с инитом
        // как аргумент в invoke всегда передается request
        // валидация данных
        $this ->validator -> validate($user);
        {

        }

        $hashPassword = $this->userRegistrationService->hashPassword($user->getPassword(), $user);
        $user->setPassword($hashPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

    }

//    public function  registration (UserPasswordHasherInterface $passwordHasher)
//    {
//
//    }
}