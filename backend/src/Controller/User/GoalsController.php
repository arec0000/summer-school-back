<?php
namespace App\Controller;

use App\Entity\Goal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;

class GoalController extends AbstractController
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

        $goals = $this->entityManager->getRepository(Goal::class)->findBy(['user' => $user]);

        if (empty($goals)) {
            return new JsonResponse(['message' => 'The user does not have such a resource']);
        }

        $response = [];

        foreach ($goals as $goal) {
            $response[] = [
                'id' => $goal->getId(),
                'name' => $goal->getName(),
                'description' => $goal->getDescription(),
                'createdAt' => $goal->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $goal->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($response);
    }
}