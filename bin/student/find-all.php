<?php

use JGabrielrc\DoctrineCourse\Entity\Student;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

require_once 'vendor/autoload.php';

$entityManager = EntityManagerFactory::create();
$studentRepository = $entityManager->getRepository(Student::class);

/** @var Student[] $students */
$students = $studentRepository->findAll();

foreach ($students as $student) {
    echo "ID: {$student->getId()}" . PHP_EOL;
    echo "NAME: {$student->getName()}" . PHP_EOL;

    $phones = $student->getPhones();

    echo "PHONES:" . PHP_EOL;
    foreach ($phones as $phone) {
        echo ". {$phone->getNumber()}" . PHP_EOL;
    }

    echo PHP_EOL;
}
