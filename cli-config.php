<?php

require 'vendor/autoload.php';

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use JGabrielrc\DoctrineCourse\Helper\EntityManagerFactory;

$config = new PhpFile(__DIR__ . '/migrations.php');

$entityManager = EntityManagerFactory::create();

return DependencyFactory::fromEntityManager(
    $config,
    new ExistingEntityManager($entityManager)
);