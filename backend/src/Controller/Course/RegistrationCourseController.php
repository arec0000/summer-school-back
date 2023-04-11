<?php

namespace App\Controller\Course;

use App\Entity\Course\Course;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RegistrationCourseController extends AbstractController
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
        $course = new Course ();
        $data = json_decode($request->getContent());
        $course->setTitle($data->title);
        $course->setDescription($data->description);
        $course->setThumbnail($data->thumbnail);
        $course->setStudentCapacity($data->studentCapacity);
        $course->setStartTime($data->startTime);
        $course->setDuration($data->duration);


        $errors=$this ->validator->validate($course);
        if (count($errors) > 0)
        {
            return new JsonResponse(['message'=>'No valid data'], 500);
        }

        $this->entityManager->persist($course);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Course created'], Response::HTTP_CREATED);

    }
}
