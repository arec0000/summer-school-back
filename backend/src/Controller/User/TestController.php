<?php


namespace App\Controller\Course;

use App\Entity\Course\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/courses/{courseId}/tests', name: 'get_tests', methods: ['GET'])]
    public function getTests(int $courseId): JsonResponse
    {
        $course = $this->entityManager->getRepository(Course::class)->find($courseId);

        if (!$course) {
            return new JsonResponse(['message' => 'Course not found'], 404);
        }

        $tests = $course->getTests();

        if (empty($tests)) {
            return new JsonResponse(['message' => 'There are no tests for this course']);
        }

        $response = [];

        foreach ($tests as $test) {
            $response[] = [
                'id' => $test->getId(),
                'name' => $test->getName(),
                'description' => $test->getDescription(),
                'createdAt' => $test->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $test->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($response);
    }
}