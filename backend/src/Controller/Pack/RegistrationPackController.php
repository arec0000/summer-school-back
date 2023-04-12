<?php

namespace App\Controller\Pack;

use App\Entity\Pack\Pack;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationPackController extends  AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private  ValidatorInterface $validator,
    )
    {

    }
    public function __invoke(Pack $pack, Request $request)

    {
        $errors=$this ->validator->validate($pack);
        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }

        $this->entityManager->persist($pack);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Pack created'], Response::HTTP_CREATED);

    }
}