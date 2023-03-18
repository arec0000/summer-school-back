<?php

namespace App\Entity\Feedback;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Course\Course;
use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Action\PlaceholderAction;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\CreateBookPublication;

#[ApiResource]
#[ORM\Entity]

#[ApiResource(operations: [
    new Get(),
    new Post(
        name: 'Feedback',
        uriTemplate: '/Feedback/{id}/publication',
        controller: CreateBookPublication::class
    )
])]

/** Feedback for course */
class Feedback
{
    /** @var int|null the Id of feedback */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer", nullable: true )]
    private ?int $id = null;

    /** @var string|null text */
    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    private ?string $feedbackText = null;

    #[ORM\ManyToOne(targetEntity: Course::class,inversedBy: 'feedback')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    #[ORM\ManyToOne(inversedBy: 'feedback')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @return string|null
     */
    public function getFeedbackText(): ?string
    {
        return $this->feedbackText;
    }

    /**
     * @param string|null $feedbackText
     */
    public function setFeedbackText(?string $feedbackText): void
    {
        $this->feedbackText = $feedbackText;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

}