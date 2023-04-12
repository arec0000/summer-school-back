<?php

namespace App\Controller\Lesson;

use App\Entity\Lesson\Lesson;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationLessonController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private  ValidatorInterface $validator,
    )
    {

    }
    public function __invoke(Lesson $lesson, Request $request)

    {

        $errors=$this ->validator->validate($lesson);
        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }

        $this->entityManager->persist($lesson);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Lesson created'], Response::HTTP_CREATED);
    }
}