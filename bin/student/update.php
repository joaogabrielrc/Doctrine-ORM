<?php

use JGabrielrc\DoctrineCourse\Entity\Student;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

require_once 'vendor/autoload.php';

$input = array(
  'id' => $argv[1],
  'name' => $argv[2]
);

$entityManager = EntityManagerFactory::create();

/** @var Student $student */
$student = $entityManager->find(Student::class, $input['id']);

$student->setName($input['name']);

$entityManager->flush();
