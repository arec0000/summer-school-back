<?php

namespace App\Controller\Feedback;

use App\Entity\Feedback\Feedback;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
class RegistrarionFeedbackController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private  ValidatorInterface $validator,

    )
    {
    }
    public function __invoke(Feedback $feedback,Request $request)

    {
        $errors=$this ->validator->validate($feedback);
        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }

        $this->entityManager->persist($feedback);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Feedback created'], Response::HTTP_CREATED);

    }
}