<?php

use JGabrielrc\DoctrineCourse\Entity\Student;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

require_once 'vendor/autoload.php';

$input = array(
  'id' => $argv[1]
);

$entityManager = EntityManagerFactory::create();
$student = $entityManager->find(
  Student::class,
  $input['id']
);

$entityManager->remove($student);
$entityManager->flush();
