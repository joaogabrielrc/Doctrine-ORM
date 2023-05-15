<?php

use JGabrielrc\DoctrineCourse\Entity\Phone;
use JGabrielrc\DoctrineCourse\Entity\Student;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

require_once 'vendor/autoload.php';

$input = array(
    'name' => $argv[1]
);

$entityManager = EntityManagerFactory::create();

$student = new Student($input['name']);

$student->addPhone(new Phone('5531911111111'));
$student->addPhone(new Phone('5531922222222'));

$entityManager->persist($student);
$entityManager->flush();
