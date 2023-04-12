<?php

namespace App\Entity\News;

use ApiPlatform\Metadata\ApiResource;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\News\RegistrationNewsController;
#[ApiResource(operations: [
    new Post
    (uriTemplate: '/news/register ',
        controller: RegistrationNewsController::class,
        denormalizationContext: ['groups' => 'createNews'],
        name: 'RegistrationNews'),
    new Get(),
    new GetCollection(),
    new Delete(),
    new Put(),
    new Patch()
]
)]
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
    #[Groups('createNews')]
    private ?string $title = null;

    /**
     * @var string|null the description of course
     */
    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    #[Groups('createNews')]
    private ?string $description = null;

    /** @var string|null picture for course */
    #[ORM\Column(type: "string",length: 255)]
    #[Groups('createNews')]
    private ?string $thumbnail =null;

    /** @var DateTimeInterface|null Star Date of course */
    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank]
    #[Groups('createNews')]
    private ?DateTimeInterface $date = null;

    #[ORM\Column(type: "string",length: 100000)]
    #[Groups('createNews')]
    private ?string $image = null;

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

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }
}