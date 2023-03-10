<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Applications\applications;
use App\Entity\Course\Course;
use App\Entity\Feedback\Feedback;
use App\Entity\Goals\Goal;
use App\Entity\Teachers\Teachers;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


//Аннотации для того чтобы сущность появилась в swagger и также была таблицей в бд
#[ApiResource]
#[ORM\Entity]
class User
{
    // Аннотации для того чтобы свойство класса стало атрибутом в бд
    // для того чтобы создать бд нужно заполнить .envExample параметр DATABASE_URL
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

    #[ORM\Column(type: "string",length: 255)]
    public string $name;

    // обязательные поля в базе данных, и соответственно необходимые поля для создания пишутся так.
    #[ORM\Column(type: "string",length: 255)]
    public string $surname;

    // необязательные поля, зануляются по умолчанию в бд и в коде вот так.
    #[ORM\Column(type: "string",length: 255, nullable: true)]
    public ?string $patronymic = null;

    #[ORM\Column(type: "integer",length: 10, nullable: true)]
    public ?int $age = null;

    #[ORM\Column(type: "string", nullable: true)]
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

    public function getId(): int
    {
        return $this->id;
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

}

