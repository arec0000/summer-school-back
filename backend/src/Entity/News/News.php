<?php

namespace App\Entity\News;

use ApiPlatform\Metadata\ApiProperty;
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
    new GetCollection(),
    new Delete(),
    new Put(),
    new Post(
        controller: RegistrationNewsController::class,
        deserialize: false,
//        security: 'is_granted("ROLE_USER")',
        normalizationContext: ['groups' => 'readNews'],
        openapiContext: [
            'requestBody' => [
                'description' => 'Upload image',
                'required' => true,
                'content' => [
                    'multipart/form-data' => [
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'file' => [
                                    'type' => 'string',
                                    'format' => 'binary',
                                    'description' => 'Upload the required image file'
                                ],
                                'description' => [
                                    'type' => 'string',
                                    'format' => 'string',
                                    'description' => 'Some description'
                                ],
                                'title' => [
                                    'type' => 'string',
                                    'format' => 'string',
                                    'description' => 'title of News'
                                ],
                                'thumbnail' => [
                                    'type' => 'string',
                                    'format' => 'string',
                                    'description' => 'thumbnail of News'
                                ],

                            ]
                        ]
                    ]
                ]
            ]
        ]
    )
])]

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
    #[Groups("readNews")]
    private ?string $title = null;

    /**
     * @var string|null the description of course
     */
    #[ORM\Column(type: "string", length: 10000)]
    #[Assert\NotBlank]
    #[Groups("readNews")]
    private ?string $description = null;

    /** @var string|null picture for course */
    #[ORM\Column(type: "string",length: 255)]
    #[Groups("readNews")]
    private ?string $thumbnail =null;

    /** @var DateTimeInterface|null Star Date of course */
    #[ORM\Column(type: "datetime")]
    #[Groups("readNews")]
    #[Assert\NotBlank]
    private ?DateTimeInterface $date = null;


    #[Groups("readNews")]
    private ?string  $file = null;

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * @param string|null $file
     */
    public function setFile(?string $file): void
    {
        $this->file = $file;
    }



    /**
     * @return string|null
     */


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

}