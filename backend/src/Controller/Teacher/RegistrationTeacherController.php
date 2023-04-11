<?php

namespace App\Controller\Teacher;

use App\Entity\Teachers\Teachers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
class RegistrationTeacherController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private  ValidatorInterface $validator,

    )
    {

    }
    public function __invoke(Request $request)

    {
        $teacher = new Teachers();
        $data = json_decode($request->getContent());
        $teacher->setName($data->name);
        $teacher->setSurname($data->surname);
        $teacher->setPatronymic($data->patronymic);
        $teacher->setAge($data->age);
        $teacher->setEmail($data->email);
        $teacher->setPhone($data->phone);

        $errors=$this ->validator->validate($teacher);
        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }

        $this->entityManager->persist($teacher);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Teacher created'], Response::HTTP_CREATED);

    }
}