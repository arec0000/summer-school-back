<?php

namespace App\Entity\Teachers;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Teacher\RegistrationTeacherController;
use App\Entity\Course\Course;
use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(operations: [
    new Post
    (uriTemplate: '/teacher/register',
        controller: RegistrationTeacherController::class,
        name: "RegistrationTeacher"),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(),
    new Patch()
]
)]
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
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Ваше имя не может содержать цифру',
        match: false,
    )]
    private string $name;

    #[ORM\Column(type: "string",length: 255)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Ваша фамилия не может содержать цифру',
        match: false,
    )]
    private string $surname;

    #[ORM\Column(type: "string",length: 255,nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Ваше отчество не может содержать цифру',
        match: false,
    )]
    private ?string $patronymic = null;

    #[ORM\Column(type: "integer",length: 10 ,nullable: true)]
    #[Assert\NotBlank]
    private ?int $age = null;

    #[ORM\Column(type: "string", unique: true)]
    #[Assert\Email(
        message: 'Email {{ value }} не является валидным email.',
    )]
    #[Assert\NotBlank]
    private ?string $email = null;

    #[ORM\Column(unique: true)]
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^((\+7|7|8)+([0-9]){10})$/')]
    private ?string $phone = null;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    /**
     * @param string|null $patronymic
     */
    public function setPatronymic(?string $patronymic): void
    {
        $this->patronymic = $patronymic;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     */
    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
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