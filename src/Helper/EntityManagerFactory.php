<?php

namespace JGabrielrc\DoctrineCourse\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;


class EntityManagerFactory
{
    /**
     * @throws MissingMappingDriverImplementation
     * @throws Exception
     */
    public static function create(): EntityManager
    {
        $env = parse_ini_file('.env');

        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array(__DIR__ . "/.."),
            isDevMode: true,
        );

        $connection = DriverManager::getConnection([
            'dbname' => $env['DATABASE_NAME'],
            'user' => $env['DATABASE_USER'],
            'password' => $env['DATABASE_PASSWORD'],
            'host' => $env['DATABASE_HOST'],
            'driver' => $env['DATABASE_DRIVER'],
        ], $config);

        return new EntityManager($connection, $config);
    }
}
