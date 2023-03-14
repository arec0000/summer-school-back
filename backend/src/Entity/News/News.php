<?php

namespace App\Entity\News;

use ApiPlatform\Metadata\ApiResource;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
class News
{
    /** @var int|null id of news */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $id = null;

    /**
     * @var string|null The title of news
     */
    #[Assert\NotBlank]
    #[ORM\Column(type: "string",length: 255)]
    private ?string $title = null;

    /**
     * @var string|null the description of course
     */
    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    private ?string $description = null;

    /** @var string|null picture for course */
    #[ORM\Column(type: "string",length: 255)]
    private ?string $thumbnail =null;

    /** @var DateTimeInterface|null Star Date of course */
    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank]
    private ?DateTimeInterface $date = null;

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




}