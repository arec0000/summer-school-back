<?php

namespace App\Entity\Applications;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Course\Course;
use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ApiResource]
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

    #[ORM\Column(type: "string")]
    #[NotBlank]
    private ?string $status = null;

    #[ORM\OneToOne(inversedBy: 'applications', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    #[ORM\OneToOne(inversedBy: 'applications', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

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

    public function setCourse(Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
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


}