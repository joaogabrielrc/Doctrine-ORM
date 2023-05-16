<?php

use JGabrielrc\DoctrineCourse\Entity\Student;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

require_once 'vendor/autoload.php';

$entityManager = EntityManagerFactory::create();
$dql = 'SELECT student, phone, course 
        FROM JGabrielrc\DoctrineCourse\Entity\Student student 
        LEFT JOIN student.phones phone
        LEFT JOIN student.courses course';

/** @var Student[] $students */
$students = $entityManager->createQuery($dql)->getResult();

foreach ($students as $student) {
    echo "ID: {$student->getId()}" . PHP_EOL;
    echo "NAME: {$student->getName()}" . PHP_EOL;

    $phones = $student->getPhones();
    echo "PHONES:" . PHP_EOL;
    foreach ($phones as $phone) {
        echo ". {$phone->getNumber()}" . PHP_EOL;
    }

    $courses = $student->getCourses();
    echo "COURSES:" . PHP_EOL;
    foreach ($courses as $course) {
        echo ". {$course->getName()}" . PHP_EOL;
    }

    echo PHP_EOL;
}
