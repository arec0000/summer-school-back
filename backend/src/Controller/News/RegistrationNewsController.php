<?php

namespace App\Controller\News;

use App\Entity\News\News;
use App\Form\NewsCreateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationNewsController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager,
        private ValidatorInterface     $validator
    )
    {

    }

    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent());
        $news = new News;


        return $this->json(['message' => 'OK'], 201);
    }

}