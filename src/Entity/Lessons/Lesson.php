<?php

namespace App\Entity\Lessons;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Group\group;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ApiResource]
#[ORM\Entity]
class Lesson
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $topic = null;

    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $start_time = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $end_time = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?group $group = null;

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
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface|null $date
     */
    public function setDate(?\DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return $this->start_time;
    }

    /**
     * @param string|null $start_time
     */
    public function setStartTime(?string $start_time): void
    {
        $this->start_time = $start_time;
    }

    /**
     * @return string|null
     */
    public function getEndTime(): ?string
    {
        return $this->end_time;
    }

    /**
     * @param string|null $end_time
     */
    public function setEndTime(?string $end_time): void
    {
        $this->end_time = $end_time;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBand(): ?group
    {
        return $this->group;
    }

    public function setBand(?group $group): self
    {
        $this->group = $group;

        return $this;
    }



}