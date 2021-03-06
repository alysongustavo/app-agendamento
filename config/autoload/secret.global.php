<?php

declare(strict_types=1);

// phpcs:disable PSR12.Files.FileHeader.IncorrectOrder

/**
 * Development-only configuration.
 *
 * Put settings you want enabled when under development mode in this file, and
 * check it into your repository.
 *
 * Developers on your team will then automatically enable them by calling on
 * `composer development-enable`.
 */

use Mezzio\Container;
use Mezzio\Middleware\ErrorResponseGenerator;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;

return [
    'dependencies' => [
        'factories' => [
            ErrorResponseGenerator::class => Container\WhoopsErrorResponseGeneratorFactory::class,
            'Mezzio\Whoops'               => Container\WhoopsFactory::class,
            'Mezzio\WhoopsPageHandler'    => Container\WhoopsPageHandlerFactory::class,
        ],
    ],
    'whoops'       => [
        'json_exceptions' => [
            'display'    => true,
            'show_trace' => true,
            'ajax_only'  => true,
        ],
    ],
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => ['url' => 'mysql://alyson:computacao2014@192.168.1.25/db_appagendamento'],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => MappingDriverChain::class,
                'drivers' => [
                    'Base\Entity' => 'app_entity',
                ],
            ],
            'app_entity' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../../src/Base/src/Entity',
                ],
            ],
        ],
    ],
];
