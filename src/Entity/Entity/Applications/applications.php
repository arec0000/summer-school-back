<?php

namespace App\Entity\Entity\Applications;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Entity\Course\Course;
use App\Entity\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ApiResource]
#[ORM\Entity]
class applications
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

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

}