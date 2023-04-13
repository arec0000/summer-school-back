<?php

namespace App\Entity\Course;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Course\RegistrationCourseController;
use App\Entity\Applications\Applications;
use App\Entity\Feedback\Feedback;
use App\Entity\Goals\Goal;
use App\Entity\Pack\Pack;
use App\Entity\Teachers\Teachers;
use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/** information about course */
#[ORM\Entity]
#[ApiResource(operations: [
    new Post
    (uriTemplate: '/course/register',
        controller: RegistrationCourseController::class,
        denormalizationContext: ['groups' => 'createCourse'],
        deserialize: false,
        name: "RegistrationCourse"),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(),
    new Patch()
]
)]
class Course
{
    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->feedback = new ArrayCollection();
        $this->teachers = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->pack = new ArrayCollection();
        $this->application = new ArrayCollection();
    }

    /**
     * @var int|null The id of course
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $id = null;

    /**
     * @var string|null The title of course
     */
    #[Assert\NotBlank]
    #[ORM\Column(type: "string",length: 255)]
    #[Groups('createCourse')]
    private ?string $title = null;

    /**
     * @var string|null the description of course
     */
    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    #[Groups('createCourse')]
    private ?string $description = null;

    /** @var string|null picture for course */
    #[ORM\Column(type: "string",length: 255)]
    #[Assert\NotBlank]
    #[Groups('createCourse')]
    private ?string $thumbnail =null;

    /** @var int|null the studentCapacity of course */
    #[ORM\Column(type: "integer")]
    #[Assert\NotNull]
    #[Groups('createCourse')]
    private ?int $studentCapacity = null;


    #[ORM\Column(type: "string",length: 255)]
    #[Assert\NotBlank]
    #[Groups('createCourse')]
    private ?string $startTime = null;

    /** @var string|null The duration of course */
    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Groups('createCourse')]
    private ?string $duration = null;

    #[ORM\OneToMany(mappedBy: 'course',targetEntity: Goal::class)]
    private ?Collection $goals = null;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: Feedback::class)]
    private ?Collection $feedback = null;

    #[ORM\ManyToMany(targetEntity: Teachers::class, mappedBy: 'course')]
    private Collection $teachers;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'course')]
    private Collection $user;


    #[ORM\OneToMany(mappedBy: 'course', targetEntity: pack::class)]
    private Collection $pack;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: Applications::class)]
    private Collection $application;


    /** @return int|null */
    public function getId(): ?int
    {
        return $this->id;
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

    /** @param string|null $description */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /** @return int|null */
    public function getStudentCapacity(): ?int
    {
        return $this->studentCapacity;
    }

    /** @param int|null $studentCapacity */
    public function setStudentCapacity(?int $studentCapacity): void
    {
        $this->studentCapacity = $studentCapacity;
    }

    /** @return string|null */
    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    public function setStartTime(?string $startTime): void
    {
        $this->startTime = $startTime;
    }

    /** @return string|null */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /** @param string|null $duration */
    public function setDuration(?string $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param string|null $thumbnail
     */
    public function setThumbnail(?string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    /** @return Collection<int, Goal> */
    public function getGoals(): Collection
    {
        return $this->goals;
    }


    /** @return Collection<int, Feedback> */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    /** @return Collection<int, Teachers> */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    /** @return Collection<int, User> */
    public function getUser(): Collection
    {
        return $this->user;
    }
    /**
    * @return Collection<int, pack>
    */
    public function getPack(): Collection
    {
        return $this->pack;
    }

    /**
     * @return Collection<int, Applications>
     */
//    public function getApplication(): Collection
//    {
//        return $this->application;
//    }

/**
 * @return Collection<int, Applications>
 */
public function getApplication(): Collection
{
    return $this->application;
}



}