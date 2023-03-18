<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/api/users/{user_id}/feedback", methods={"POST"})
     */
    public function sendFeedback(Request $request, User $user)
    {
        // Проверяем, имеет ли текущий пользователь право отправлять фидбек
        $this->denyAccessUnlessGranted('sendFeedback', $user);

        $form = $this->createForm(FeedbackType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feedback = $form->getData();

            // Отправляем фидбек пользователю
            $this->sendFeedbackToUser($user, $feedback);

            return new JsonResponse(['message' => 'Feedback sent successfully'], 200);
        }

        return new JsonResponse(['error' => 'Invalid form data'], 400);
    }
