<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Validator\ValidatorInterface;
use App\Entity\User\User;
use App\Services\User\UserRegistrationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RegistrationUserController extends AbstractController
{
    public function __construct
    (
        private  EntityManagerInterface $entityManager,
        private  ValidatorInterface     $validator,
        private  UserRegistrationService  $userRegistrationService
    )
    {

    }
    public function __invoke(User $user, Request $request, ValidatorInterface $validator): void

    {
        //это магический метод, но чем-то схож с инитом
        // как аргумент в invoke всегда передается request
        // валидация данных
        $this->validator->validate($user);
        $hashPassword = $this->userRegistrationService->hashPassword($user, $user->getPassword());
        $user->setPassword($hashPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

    }
}