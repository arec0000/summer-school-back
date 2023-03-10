<?php

namespace App\Entity\Entity\Teachers;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Entity\Course\Course;
use App\Entity\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity]
class Teachers
{

    public function __construct()
    {
        $this->course = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    /** @var int|null The id for teachers */
    #[ORM\Id]
    #[ORM\Column(type: "integer", nullable: true)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: "string",length: 255)]
    public string $name;

    #[ORM\Column(type: "string",length: 255)]
    public string $surname;

    #[ORM\Column(type: "string",length: 255,nullable: true)]
    public ?string $patronymic = null;

    #[ORM\Column(type: "integer",length: 10 ,nullable: true)]
    public ?int $age = null;

    #[ORM\Column(type: "string", nullable: true)]
    public ?string $email = null;

    #[ORM\Column(type: "string", nullable: true)]
    public ?string $phone = null;

    #[ORM\Column(type: "string")]
    private string $password;

    #[ORM\ManyToMany(targetEntity: Course::class, inversedBy: 'teachers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collection $course = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'teachers')]
    private Collection $user;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourse(): Collection
    {
        return $this->course;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }
}