<?php

namespace App\Entity\Goals;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Goal\RegistrationGoalController;
use App\Entity\Course\Course;
use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(operations: [
    new Post
    (uriTemplate: '/goal/register',
        controller: RegistrationGoalController::class,
        denormalizationContext: ['groups' => 'createGoal'],
        deserialize: false,
        name: "RegistrationGoal"),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(),
    new Patch()
]
)]
#[ORM\Entity]
/** Goal on course */

class Goal
{

    /** @var int|null the id of goal */
    #[ORM\Id]
    #[ORM\Column(type: "integer", nullable: true)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    #[Groups('createGoal')]
    private ?string $goalText = null;


    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: 'Goals')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('createGoal')]
    private ?Course $course = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('createGoal')]
    private ?User $user = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /** @var string|null The text of goal */


    /**
     * @return string|null
     */
    public function getGoalText(): ?string
    {
        return $this->goalText;
    }

    /**
     * @param string|null $goalText
     */
    public function setGoalText(?string $goalText): void
    {
        $this->goalText = $goalText;
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