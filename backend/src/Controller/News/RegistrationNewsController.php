<?php

namespace App\Controller\News;

use App\Entity\News\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use App\Services\News\FileUploaderService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;

#[AsController]
class RegistrationNewsController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private ValidatorInterface     $validator
    )
    {

    }

    public function __invoke(Request $request, FileUploaderService $fileUploaderService): News
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile){
            throw new BadRequestHttpException('"file" is required');
        }

        $news = new News();
        $news -> setTitle($request->get('title'));
        $news -> setDescription($request->get('description'));
        $news -> setThumbnail($request->get('thumbnail'));
        $news -> setDate(new \DateTime());
        $news -> setFile($fileUploaderService->upload($uploadedFile));

        $errors=$this ->validator->validate($news);

        if (count($errors) > 0)
        {
            throw new BadRequestHttpException('no valid data');
        }

        $this->entityManager->persist($news);
        $this->entityManager->flush();
        return $news;
    }

}