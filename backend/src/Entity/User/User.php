<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\User\RegistrationUserController;
use App\Entity\Applications\Applications;
use App\Entity\Course\Course;
use App\Entity\Feedback\Feedback;
use App\Entity\Goals\Goal;
use App\Entity\Teachers\Teachers;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ApiResource(operations: [
    new Post
    (uriTemplate: '/user/register',
        controller: RegistrationUserController::class,
        denormalizationContext: ['groups' => 'createUser'],
        deserialize: false,
        name: "RegistrationUser"),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(denormalizationContext: ['groups' => 'createUser']),
    new Patch(denormalizationContext: ['groups' => 'createUser'])
]
)]
#[ORM\Entity]

class User implements  UserInterface,PasswordAuthenticatedUserInterface
{
    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->feedback = new ArrayCollection();
        $this->courses = new ArrayCollection();
        $this->teachers = new ArrayCollection();
        $this->application = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    protected int $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Groups('createUser')]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Ваше имя не может содержать цифру',
        match: false,
    )]
    private string $name;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Groups('createUser')]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Ваша фамилия не может содержать цифру',
        match: false,
    )]
    private string $surname;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\NotBlank]
    #[Groups('createUser')]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Ваше отчество не может содержать цифру',
        match: false,
    )]
    private ?string $patronymic = null;

    #[ORM\Column(type: "integer", length: 10, nullable: true)]
    #[Assert\NotBlank]
    #[Groups('createUser')]
    private ?int $age = null;

    #[ORM\Column(type: "string", unique: true)]
    #[Groups('createUser')]
    #[Assert\Email(
        message: 'Email {{ value }} не является валидным email.',
    )]
    #[Assert\NotBlank]
    private ?string $email = null;

    #[ORM\Column(unique: true)]
    #[Assert\NotBlank]
    #[Groups('createUser')]
    #[Assert\Regex(pattern: '/^((\+7|7|8)+([0-9]){10})$/')]
    private ?string $phone = null;

    #[ORM\Column(type: "string",)]
    #[Assert\NotBlank]
    #[Groups('createUser')]
    private ?string $password  ;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Goal::class)]
    private Collection $goals;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Feedback::class)]
    private Collection $feedback;

    #[ORM\ManyToMany(targetEntity: Course::class, mappedBy: 'user')]
    private Collection $courses;

    #[ORM\ManyToMany(targetEntity: Teachers::class, mappedBy: 'user')]
    private Collection $teachers;

    #[ORM\Column(type: "array") ]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Applications::class)]
    private Collection $application;

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
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
     * @return Collection<int, Goal>
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }
    /**
     * @return Collection<int, Teachers>
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function getRoles(): array
    {
        // TODO: Implement getRoles() method.
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
        return $this->email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

/**
 * @return Collection<int, Applications>
 */
public function getApplication(): Collection
{
    return $this->application;
}

}