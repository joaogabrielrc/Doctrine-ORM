<?php

use JGabrielrc\DoctrineCourse\Entity\Course;
use JGabrielrc\DoctrineCourse\Entity\Student;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

require_once 'vendor/autoload.php';

$input = array(
    'studentId' => $argv[1],
    'courseId' => $argv[2],
);

$entityManager = EntityManagerFactory::create();

$student = $entityManager->find(Student::class, $input['studentId']);
$course = $entityManager->find(Course::class, $input['courseId']);

$student->addCourse($course);

$entityManager->flush();
