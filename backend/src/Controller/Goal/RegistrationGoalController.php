<?php

namespace App\Controller\Goal;

use App\Entity\Goals\Goal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationGoalController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private  ValidatorInterface $validator,

    )
    {
    }
    public function __invoke(Goal $goal, Request $request)

    {

        $errors=$this ->validator->validate($goal);
        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }

        $this->entityManager->persist($goal);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Goal created'], Response::HTTP_CREATED);

    }
}