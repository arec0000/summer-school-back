<?php

namespace App\Entity\Goals;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Course\Course;
use App\Entity\User\User;
use Doctrine\ORM\Mapping  as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
/** Goal on course */

class Goal
{
    // Аннотации для того чтобы свойство класса стало атрибутом в бд
    // для того чтобы создать бд нужно заполнить .envExample параметр DATABASE_URL
    // после настройки, чтобы перевести эту сущность в таблицу в бд нужно через консоль выполнять следующее:
    // bin/console d:d:c && bin/console d:s:u --force --dump-sql
    // развернуть проект можно используя symfony serve -d

    /** @var int|null the Id of goal */
    #[ORM\Id]
    #[ORM\Column(type: "integer", nullable: true)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $Id = null;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    private ?string $goalText = null;


    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: 'Goals')]
    #[ORM\JoinColumn(nullable: false)]

    private ?Course $course = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->Id;
    }

    /** @var string|null The text of goal */


    /**
     * @return string|null
     */
    public function getGoalText(): ?string
    {
        return $this->goalText;
    }

    /**
     * @param string|null $goalText
     */
    public function setGoalText(?string $goalText): void
    {
        $this->goalText = $goalText;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourseId(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}