<?php

namespace App\Controller\User;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class RegistrationUserController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface      $entityManager,
        private UserPasswordHasherInterface $hasher,

    )
    {

    }

    public function __invoke(Request $request) //User $user): JsonResponse

    {

        $data = json_decode($request->getContent());

        $user = new User();
        $user->email = $data->email;

        $user->name = $data->name;
        $user->surname = $data->surname;
        $user->patronymic = $data->patronymic;
        $user->phone = $data->phone;
        $user->age = $data->age;
        $user->password = $data->password;

        $hashPassword = $this->hasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashPassword);

        $user->setRoles(["ROLE_USER"]);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'OK'], Response::HTTP_CREATED);

    }
}