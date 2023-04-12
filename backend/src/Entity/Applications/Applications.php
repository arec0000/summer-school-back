<?php

namespace App\Entity\Applications;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Applications\RegistrationApplicationController;
use App\Entity\Course\Course;
use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(operations: [
    new Post
    (uriTemplate: '/application/register',
        controller: RegistrationApplicationController::class,
        denormalizationContext: ['groups' => 'createApplication'],
        name: "RegistrationApplication"),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(),
    new Patch()
]
)]
#[ORM\Entity]
class Applications
{
    /**
     * @var int|null The id of course
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $Id = null;


    #[Assert\NotBlank]
    #[Groups('createApplication')]
    #[Assert\Choice(["1", "2","3"])]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'application')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'application')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->Id;
    }
    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
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

public function getCourse(): ?Course
{
    return $this->course;
}

public function setCourse(?Course $course): self
{
    $this->course = $course;

    return $this;
}
}