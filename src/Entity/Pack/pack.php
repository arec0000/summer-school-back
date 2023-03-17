<?php

namespace App\Entity\Pack;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Course\Course;
use App\Entity\Lesson\lesson;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]

// pack means group of people or just group
class pack
{
    #[ORM\Id]
    #[ORM\Column(type: "integer", nullable: true)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id= null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private ?string $packName= null;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank]
    private ?string $calendar_url=null;

    #[ORM\OneToMany(mappedBy: 'pack', targetEntity: lesson::class)]
    private Collection $lessons;

    #[ORM\ManyToOne(inversedBy: 'pack')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
    }

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
        return $this->calendar_url;
    }

    /**
     * @param string|null $calendar_url
     */
    public function setCalendarUrl(?string $calendar_url): void
    {
        $this->calendar_url = $calendar_url;
    }

    /**
     * @return Collection<int, lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

//    public function addLesson(lesson $lesson): self
//    {
//        if (!$this->lessons->contains($lesson)) {
//            $this->lessons->add($lesson);
//            $lesson->setPack($this);
//        }
//
//        return $this;
//    }

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