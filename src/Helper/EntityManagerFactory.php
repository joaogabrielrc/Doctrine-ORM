<?php

namespace JGabrielrc\DoctrineCourse\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Cache\Exception\CacheException;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;


class EntityManagerFactory
{
    /**
     * @throws MissingMappingDriverImplementation
     * @throws Exception
     * @throws CacheException
     */
    public static function create(): EntityManager
    {
        $env = parse_ini_file('.env');

        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array(__DIR__ . "/.."),
            isDevMode: true,
        );

        $config->setMiddlewares([
            new Middleware(
                new ConsoleLogger(
                    new ConsoleOutput(
                        OutputInterface::VERBOSITY_DEBUG
                    )
                )
            )
        ]);

        $cacheDirectory = __DIR__ . '/../../var/cache';

        $config->setMetadataCache(
            new PhpFilesAdapter(
                namespace: 'metadata_cache',
                defaultLifetime: 0,
                directory: $cacheDirectory
            )
        );

        $config->setQueryCache(
            new PhpFilesAdapter(
                namespace: 'query_cache',
                defaultLifetime: 0,
                directory: $cacheDirectory
            )
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
