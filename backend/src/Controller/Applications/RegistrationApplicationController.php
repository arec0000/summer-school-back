<?php

namespace App\Controller\Applications;


use App\Entity\Applications\Applications;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RegistrationApplicationController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private  ValidatorInterface $validator,
    )
    {

    }

    public function __invoke(Applications $applications, EntityManagerInterface $entityManager)

    {

        $errors=$this ->validator->validate($applications);
        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }

        $this->entityManager->persist($applications);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Application created'], Response::HTTP_CREATED);

    }
}