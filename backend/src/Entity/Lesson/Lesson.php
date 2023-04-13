<?php

namespace App\Entity\Lesson;

use App\Controller\Lesson\RegistrationLessonController;
use App\Entity\Pack\Pack;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Entity\Teachers\Teachers;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(operations: [
    new Post
    (uriTemplate: '/lesson/register',
        controller: RegistrationLessonController::class,
        deserialize: false,
        denormalizationContext: ['groups' => 'createLesson'],
        name: "RegistrationLesson"),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(),
    new Patch()
]
)]
#[ORM\Entity]
class Lesson
{
    #[ORM\Id]
    #[ORM\Column(type: "integer",nullable: true)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Groups('createLesson')]
    private ?string $title = null;

    #[ORM\Column(type: "string", length: 1000)]
    #[Assert\NotBlank]
    #[Groups('createLesson')]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Groups('createLesson')]
    private ?string $topic = null;

    #[Assert\NotBlank]
    #[Assert\Date(
        message: 'date {{ value }} не является валидным date.'
    )]
    #[Groups('createLesson')]
    private ?DateTimeInterface $date = null;

    #[Assert\Time(
        message: 'start_time {{ value }} не является валидным start_time.'
    )]
    #[Assert\NotBlank]
    #[Groups('createLesson')]
    private ?DateTimeInterface $startTime = null;

    #[Assert\Time(
        message: 'end_time {{ value }} не является валидным end_time.'
    )]
    #[Groups('createLesson')]
    #[Assert\NotBlank]
    private ?DateTimeInterface $endTime = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('createLesson')]
    private ?pack $pack = null;

    #[ORM\ManyToOne(inversedBy: 'lesson')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('createLesson')]
    private ?Teachers $teacher = null;

    /**
     * @return int|null
     */
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

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getTopic(): ?string
    {
        return $this->topic;
    }

    /**
     * @param string|null $topic
     */
    public function setTopic(?string $topic): void
    {
        $this->topic = $topic;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface|null $date
     */
    public function setDate(?DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStartTime(): ?DateTimeInterface
    {
        return $this->startTime;
    }

    /**
     * @param DateTimeInterface|null $startTime
     */
    public function setStartTime(?DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndTime(): ?DateTimeInterface
    {
        return $this->endTime;
    }

    /**
     * @param DateTimeInterface|null $endTime
     */
    public function setEndTime(?DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }


    public function getPack(): ?pack
    {
        return $this->pack;
    }

    public function setPack(?pack $pack): self
    {
        $this->pack = $pack;

        return $this;
    }

    public function getTeacher(): ?Teachers
    {
        return $this->teacher;
    }

    public function setTeacher(?Teachers $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }



}