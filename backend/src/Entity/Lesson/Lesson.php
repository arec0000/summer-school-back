<?php

namespace App\Entity\Lesson;
use App\Entity\Pack\Pack;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ORM\Entity]
class Lesson
{
    #[ORM\Id]
    #[ORM\Column(type: "integer",nullable: true)]
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
    private ?DateTimeInterface $date = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?DateTimeInterface $start_time = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?DateTimeInterface $end_time = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?pack $pack = null;

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
        return $this->start_time;
    }

    /**
     * @param DateTimeInterface|null $start_time
     */
    public function setStartTime(?DateTimeInterface $start_time): void
    {
        $this->start_time = $start_time;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndTime(): ?DateTimeInterface
    {
        return $this->end_time;
    }

    /**
     * @param DateTimeInterface|null $end_time
     */
    public function setEndTime(?DateTimeInterface $end_time): void
    {
        $this->end_time = $end_time;
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



}