<?php

namespace JGabrielrc\DoctrineCourse\Repository;

use Doctrine\ORM\EntityRepository;
use JGabrielrc\DoctrineCourse\Entity\Student;

class StudentRepository extends EntityRepository
{
    /**
     * @return Student[]
     */
    public function findAllStudentsAndCourses(): array
    {
        return $this->createQueryBuilder('student')
            ->addSelect('phone')
            ->addSelect('course')
            ->leftJoin('student.phones', 'phone')
            ->leftJoin('student.courses', 'course')
            ->getQuery()
            ->getResult();
    }
}