<?php

namespace JGabrielrc\DoctrineCourse\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'students')]
class Student
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Phone::class, cascade: ["persist", "remove"])]
    private Collection $phones;

    #[ORM\ManyToMany(targetEntity: Course::class, inversedBy: 'students')]
    private Collection $courses;

    public function __construct(
        #[ORM\Column(type: 'string')]
        private string $name
    )
    {
        $this->phones = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection<Phone>
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): void
    {

        $this->phones->add($phone);
        $phone->setStudent($this);
    }

    /**
     * @return Collection<Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    /**
     * @param Course $course
     */
    public function addCourse(Course $course): void
    {
        if ($this->courses->contains($course)) return;

        $this->courses->add($course);
        $course->addStudent($this);
    }

}