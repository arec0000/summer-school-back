<?php

namespace App\Entity\Course;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'json')]
    private array $questions = [];

    #[ORM\Column(type: 'json')]
    private array $answers = [];

    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: 'tests')]
    #[ORM\JoinColumn(nullable: false)]
    private Course $course;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getQuestions(): ?array
    {
        return $this->questions;
    }

    public function setQuestions(array $questions): self
    {
        $this->questions = $questions;

        return $this;
    }

    public function getAnswers(): ?array
    {
        return $this->answers;
    }

    public function setAnswers(array $answers): self
    {
        $this->answers = $answers;

        return $this;
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

    public function addQuestion(string $question, array $answers): self
    {
        $this->questions[] = $question;
        $this->answers[] = $answers;

        return $this;
    }

    public function getQuestionIndex(int $index): ?string
    {
        return isset($this->questions[$index]) ? $this->questions[$index] : null;
    }

    public function getAnswerIndex(int $index): ?array
    {
        return isset($this->answers[$index]) ? $this->answers[$index] : null;
    }

    public function getQuestionCount(): int
    {
        return count($this->questions);
    }

    public function addCourse(Course $course): self
    {
        if (!$this->course->contains($course)) {
            $this->course = $course;
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->course->contains($course)) {
            $this->course->removeElement($course);
        }

        return $this;
    }

}