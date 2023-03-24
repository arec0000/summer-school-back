<?php
namespace App\Controller;

use App\Entity\Feedback;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;

class FeedbackController extends AbstractController
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function __invoke(): JsonResponse
    {
        $user = $this->security->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'Authorization required'], 401);
        }

        if (!$user->isEnabled()) {
            throw new AccessDeniedException('User not activated.');
        }

        $feedbacks = $this->entityManager->getRepository(Feedback::class)->findBy(['user' => $user]);

        if (empty($feedbacks)) {
            return new JsonResponse(['message' => 'The user does not have such a resource']);
        }

        $response = [];

        foreach ($feedbacks as $feedback) {
            $response[] = [
                'id' => $feedback->getId(),
                'text' => $feedback->getText(),
                'createdAt' => $feedback->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $feedback->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($response);
    }
}