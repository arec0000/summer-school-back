<?php

namespace App\Entity\Course;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Feedback\Feedback;
use App\Entity\Goals\Goal;
use App\Entity\Teachers\Teachers;
use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/** information about course */
#[ORM\Entity]
#[ApiResource]
class Course
{


    // Аннотации для того чтобы свойство класса стало атрибутом в бд
    // для того чтобы создать бд нужно заполнить .envExample параметр DATABASE_URL
    // после настройки, чтобы перевести эту сущность в таблицу в бд нужно через консоль выполнять следующее:
    // bin/console d:d:c && bin/console d:s:u --force --dump-sql
    // развернуть проект можно используя symfony serve -d

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->feedback = new ArrayCollection();
        $this->teachers = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    /**
     * @var int|null The id of course
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $Id = null;

    /**
     * @var string|null The title of course
     */
    #[Assert\NotBlank]
    #[ORM\Column(type: "text")]
    private ?string $title = null;

    /**
     * @var string|null the description of course
     */
    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    private ?string $description = null;

    /**
     * @var int|null the studentCapacity of course
     */
    #[ORM\Column(type: "integer")]
    #[Assert\NotNull]
    private ?int $studentCapacity = null;


    /**
     * @var \DateTimeInterface|null Star Date of course
     */
    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $startTime = null;

    /**
     * @var string|null The duration of course
     */
    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    private ?string $duration = null;

    #[ORM\OneToMany(mappedBy: 'course',targetEntity: Goal::class)]
    private ?Collection $goals = null;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: Feedback::class)]
    private ?Collection $feedback = null;

    #[ORM\ManyToMany(targetEntity: Teachers::class, mappedBy: 'course')]
    private Collection $teachers;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'course')]
    private Collection $user;

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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getStudentCapacity(): ?int
    {
        return $this->studentCapacity;
    }

    /**
     * @param int|null $studentCapacity
     */
    public function setStudentCapacity(?int $studentCapacity): void
    {
        $this->studentCapacity = $studentCapacity;
    }



    /**
     * @return \DateTimeInterface|null
     */
    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    /**
     * @param \DateTimeInterface|null $startTime
     */
    public function setStartTime(?\DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     */
    public function setDuration(?string $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return Collection<int, Goal>
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): self
    {
        if (!$this->goals->contains($goal)) {
            $this->goals->add($goal);
            $goal->setCourseId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    public function addFeedback(Feedback $feedback): self
    {
        if (!$this->feedback->contains($feedback)) {
            $this->feedback->add($feedback);
            $feedback->setCourseId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Teachers>
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teachers $teacher): self
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers->add($teacher);
            $teacher->addCourseId($this);
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