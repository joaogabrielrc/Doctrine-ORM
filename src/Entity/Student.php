<?php

namespace JGabrielrc\DoctrineCourse\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'students')]
class Student
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    public function __construct(
        #[ORM\Column(type: 'string')]
        private string $name
    )
    {
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
    
}