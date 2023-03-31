<?php
namespace App\Controller;

use App\Entity\Course;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;

class CourseController extends AbstractController
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

        $courses = $this->entityManager->getRepository(Course::class)->findBy(['user' => $user]);

        if (empty($courses)) {
            return new JsonResponse(['message' => 'The user does not have such a resource']);
        }

        $response = [];

        foreach ($courses as $course) {
            $response[] = [
                'id' => $course->getId(),
                'name' => $course->getName(),
                'description' => $course->getDescription(),
                'createdAt' => $course->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $course->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($response);
    }
}