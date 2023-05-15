<?php

use JGabrielrc\DoctrineCourse\Entity\Course;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

require_once 'vendor/autoload.php';

$input = array(
    'name' => $argv[1]
);

$entityManager = EntityManagerFactory::create();

$course = new Course($input['name']);

$entityManager->persist($course);
$entityManager->flush();
