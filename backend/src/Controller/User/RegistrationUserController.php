<?php

namespace App\Controller\User;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Services\User\SendMailService;

class RegistrationUserController extends AbstractController
{

    public function __construct
    (
        private EntityManagerInterface      $entityManager,
        private UserPasswordHasherInterface $hasher,
        private  ValidatorInterface $validator,
        private readonly SendMailService $sendMailService

    )
    {

    }

    public function __invoke(Request $request) //User $user): JsonResponse

    {
        $user = new User();
        $data = json_decode($request->getContent());

        if (isset($data->email)) {
            $user->setEmail($data->email);
        }
        if (isset($data->name)) {
            $user->setName($data->name);
        }
        if (isset($data->surname)) {
            $user->setSurname($data->surname);
        }
        if (isset($data->patronymic)) {
            $user->setPatronymic($data->patronymic);
        }
        if (isset($data->phone)) {
            $user->setPhone($data->phone);
        }
        if (isset($data->age)) {
            $user->setAge($data->age);
        }
        if (isset($data->password)) {
            $user->setPassword($data->password);
        }

        $errors=$this ->validator->validate($user);
//        $this->sendMailServis->send($user->getEmail(),$password);

        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }
        
        $this->sendMailService->send($user->getEmail());

        $hashPassword = $this->hasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashPassword);

        $user->setRoles(["ROLE_USER"]);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'User created'], Response::HTTP_CREATED);

    }
}