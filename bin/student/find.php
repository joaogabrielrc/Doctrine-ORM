<?php

use JGabrielrc\DoctrineCourse\Entity\Phone;
use JGabrielrc\DoctrineCourse\Entity\Student;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

require_once 'vendor/autoload.php';

$input = array(
    'id' => $argv[1]
);

$entityManager = EntityManagerFactory::create();

/** @var Student $student */
$student = $entityManager->find(Student::class, $input['id']);

echo "ID: {$student->getId()}" . PHP_EOL;
echo "NAME: {$student->getName()}" . PHP_EOL;

/** @var Phone[] $phones */
$phones = $student->getPhones();

echo "PHONES:" . PHP_EOL;
foreach ($phones as $phone) {
    echo ". {$phone->getNumber()}" . PHP_EOL;
}
