<?php
namespace App\Controller\Api;

use App\Entity\News;
use App\Form\NewsCreateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class NewsCreateController extends AbstractController
{
    /**
     * @Route("/api/news", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function __invoke(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(NewsCreateType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var News $news */
            $news = $form->getData();
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('news_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    return $this->json(['error' => $e->getMessage()], 500);
                }

                $news->setImage($newFilename);
            }

            $em->persist($news);
            $em->flush();

            return $this->json($news, 201, [], ['groups' => ['api']]);
        }

        return $this->json(['error' => 'Invalid data'], 400);
    }
}