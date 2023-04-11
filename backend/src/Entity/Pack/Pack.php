<?php

namespace App\Entity\Pack;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Pack\RegistrationPackController;
use App\Entity\Course\Course;
use App\Entity\Lesson\Lesson;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[ApiResource(operations: [
    new Post
    (uriTemplate: '/pack/register',
        controller: RegistrationPackController::class,
        denormalizationContext: ['groups' => 'createPack'],
        deserialize: false,
        name: "RegistrationPack"),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(),
    new Patch()
]
)]
#[ORM\Entity]

// pack means group of people or just group
class Pack
{
    public function __construct()
    {
        $this->lessons = new ArrayCollection();

    }

    #[ORM\Id]
    #[ORM\Column(type: "integer", nullable: true)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id= null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Groups('createPack')]
    private ?string $packName= null;


    #[Assert\NotBlank]
    #[Assert\Url(
        message: 'Url {{ value }} не является валидным url',
    )]
    #[Groups('createPack')]
    private ?string $calendarUrl=null;

    #[ORM\ManyToOne(inversedBy: 'pack')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('createPack')]
    private ?Course $course = null;

    #[ORM\OneToMany(mappedBy: 'pack', targetEntity: lesson::class)]
    private Collection $lessons;

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
    public function getPackName(): ?string
    {
        return $this->packName;
    }

    /**
     * @param string|null $packName
     */
    public function setPackName(?string $packName): void
    {
        $this->packName = $packName;
    }

    /**
     * @return string|null
     */
    public function getCalendarUrl(): ?string
    {
        return $this->calendarUrl;
    }

    /**
     * @param string|null $calendarUrl
     */
    public function setCalendarUrl(?string $calendarUrl): void
    {
        $this->calendarUrl = $calendarUrl;
    }

    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

}