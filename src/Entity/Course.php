<?php

namespace JGabrielrc\DoctrineCourse\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'courses')]
class Course
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Student::class, mappedBy: 'courses')]
    private Collection $students;

    public function __construct(
        #[ORM\Column(unique: true)]
        private readonly string $name
    )
    {
        $this->students = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection<Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    /**
     * @param Student $student
     */
    public function addStudent(Student $student): void
    {
        if ($this->students->contains($student)) return;

        $this->students->add($student);
        $student->addCourse($this);
    }

    public function getName(): string
    {
        return $this->name;
    }
}