<?php

namespace App\Controller\Applications;

use App\Entity\Applications\Applications;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function __invoke(Request $request)

    {
        $application = new Applications();
        $data = json_decode($request->getContent());
        $application->setStatus($data->status);
        $application->setCourse($data->course);
        $application->setUser($data->user);

        $errors=$this ->validator->validate($application);
        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }

        $this->entityManager->persist($application);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Application created'], Response::HTTP_CREATED);

    }
}