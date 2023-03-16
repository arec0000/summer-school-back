<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\User\RegistrationUserController;
use App\Entity\Applications\applications;
use App\Entity\Course\Course;
use App\Entity\Feedback\Feedback;
use App\Entity\Goals\Goal;
use App\Entity\Teachers\Teachers;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface as PasswordAuthenticatedUserInterfaceAlias;
use Symfony\Component\Security\Core\User\UserInterface;


//Аннотации для того чтобы сущность появилась в swagger и также была таблицей в бд
#[ApiResource(
    operations: [
    new Post
    (uriTemplate:'/user/register',
    controller: RegistrationUserController::class,
    name: "RegistrationUser")
        ]
)]
#[ORM\Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterfaceAlias
{
    // Аннотации для того чтобы свойство класса стало атрибутом в бд
    // для того чтобы создать бд нужно заполнить .env параметр DATABASE_URL
    // после настройки, чтобы перевести эту сущность в таблицу в бд нужно через консоль выполнять следующее:
    // bin/console d:d:c && bin/console d:s:u --force --dump-sql
    // развернуть проект можно используя symfony serve -d

    //TODO сделать абстрактный класс BaseEntity, от которого будут наследоваться все остальные. В нем собрать все поля по умолчанию
    // id, dateCreate, dateUpdate


    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->feedback = new ArrayCollection();
        $this->courses = new ArrayCollection();
        $this->teachers = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    protected int $id;

    #[ORM\Column(type: "string", length: 255)]
    public string $name;

    // обязательные поля в базе данных, и соответственно необходимые поля для создания пишутся так.
    #[ORM\Column(type: "string", length: 255)]
    public string $surname;

    // необязательные поля, зануляются по умолчанию в бд и в коде вот так.
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    public ?string $patronymic = null;

    #[ORM\Column(type: "integer", length: 10, nullable: true)]
    public ?int $age = null;

    #[ORM\Column(type: "string", unique: true)]
    public ?string $email = null;

    #[ORM\Column(type: "string", nullable: true)]
    public ?string $phone = null;

    #[ORM\Column(type: "string",)]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Goal::class)]
    private Collection $goals;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Feedback::class)]
    private Collection $feedback;

    #[ORM\ManyToMany(targetEntity: Course::class, mappedBy: 'user')]
    private Collection $courses;

    #[ORM\ManyToMany(targetEntity: Teachers::class, mappedBy: 'user')]
    private Collection $teachers;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?applications $applications = null;
    #[ORM\Column(type: "string") ]
    private array $roles = ["user"];

    // TODO добавить поле role, когда будет таска на авторизацию

    // Методы пишем после свойств. Поля пароля и айди приватные по умолчанию
    // для них нужны гетеры и сетеры, функции которые позволяют получать приватные свойства из объекта класса.
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

    public function getApplications(): ?applications
    {
        return $this->applications;
    }

    public function getRoles(): array
    {
        // TODO: Implement getRoles() method.
        return $this->roles;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
        return $this->id;
    }

}


