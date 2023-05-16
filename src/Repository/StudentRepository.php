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
        $dql = 'SELECT student, phone, course 
        FROM JGabrielrc\DoctrineCourse\Entity\Student student 
        LEFT JOIN student.phones phone
        LEFT JOIN student.courses course';
        return $this->getEntityManager()->createQuery($dql)->getResult();
    }
}