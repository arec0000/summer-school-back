<?php

namespace App\Entity\Group;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Lesson\Lesson;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ApiResource]
#[ORM\Entity]
class Group

{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id= null;
    #[ORM\Column(type: "string")]
    private ?string $groupName= null;
    #[ORM\Column(type: "string")]
    private ?string $calendar_url=null;

    #[ORM\OneToMany(mappedBy: 'band', targetEntity: Lesson::class)]
    private Collection $lessons;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->groupName;
    }

    /**
     * @param string $groupName
     */
    public function setGroupName(string $groupName): void
    {
        $this->groupName = $groupName;
    }

    /**
     * @return string
     */
    public function getCalendarUrl(): string
    {
        return $this->calendar_url;
    }

    /**
     * @param string $calendar_url
     */
    public function setCalendarUrl(string $calendar_url): void
    {
        $this->calendar_url = $calendar_url;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

}
