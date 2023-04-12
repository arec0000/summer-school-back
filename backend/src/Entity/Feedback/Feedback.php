<?php

namespace App\Entity\Feedback;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Feedback\RegistrarionFeedbackController;
use App\Entity\Course\Course;
use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(operations: [
    new Post
    (uriTemplate: '/feedback/register',
        controller: RegistrarionFeedbackController::class,
        denormalizationContext: ['groups' => 'createFeedback'],
        name: "RegistrationFeedback"),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(),
    new Patch()
]
)]
#[ORM\Entity]
/** Feedback for course */
class Feedback
{
    /** @var int|null the Id of feedback */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer", nullable: true )]
    private ?int $Id = null;

    /** @var string|null text */
    #[ORM\Column(type: "string", length: 10000)]
    #[Assert\NotBlank]
    #[Groups('createFeedback')]
    private ?string $feedbackText = null;

    #[ORM\ManyToOne(targetEntity: Course::class,inversedBy: 'feedback')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('createFeedback')]
    private ?Course $course = null;

    #[ORM\ManyToOne(inversedBy: 'feedback')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('createFeedback')]
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
        return $this->Id;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}