<?php

namespace App\Entity\Teachers;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Course\Course;
use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
class Teachers
{
    // Аннотации для того чтобы свойство класса стало атрибутом в бд
    // для того чтобы создать бд нужно заполнить .envExample параметр DATABASE_URL
    // после настройки, чтобы перевести эту сущность в таблицу в бд нужно через консоль выполнять следующее:
    // bin/console d:d:c && bin/console d:s:u --force --dump-sql
    // развернуть проект можно используя symfony serve -d

    /** @var int|null The Id for teachers */
    #[ORM\Id]
    #[ORM\Column(type: "integer", nullable: true)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $Id = null;

    #[ORM\Column(type: "string")]
    public string $name;

    #[ORM\Column(type: "string")]
    public string $surname;

    #[ORM\Column(type: "string", nullable: true)]
    public ?string $patronymic = null;

    #[ORM\Column(type: "integer", nullable: true)]
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
        return $this->Id;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function __construct()
    {
        $this->course = new ArrayCollection();
        $this->user = new ArrayCollection();
    }


    /**
     * @return Collection<int, Course>
     */
    public function getCourse(): Collection
    {
        return $this->course;
    }

    public function addCourseId(Course $course): self
    {
        if (!$this->course->contains($course)) {
            $this->course->add($course);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }
}