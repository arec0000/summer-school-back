<?php

namespace App\Controller\User;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationUserController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $hasher
    )
    {

    }
    public function __invoke(User $user): JsonResponse

    {
        //это магический метод, но чем-то схож с инитом
        // как аргумент в invoke всегда передается request
        // валидация данных
        // тут надо добавить управление ролями
        $hashPassword = $this->hasher -> hashPassword($user, $user->getPassword());
        $user->setPassword($hashPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'OK'], Response::HTTP_CREATED);

    }
}