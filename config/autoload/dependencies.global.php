<?php

declare(strict_types=1);

use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Roave\PsrContainerDoctrine\Migrations\CommandFactory;
use Doctrine\Migrations\Configuration\Migration\ConfigurationLoader;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManager;
use Roave\PsrContainerDoctrine\Migrations\DependencyFactoryFactory;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            // Fully\Qualified\ClassName::class => Fully\Qualified\FactoryName::class,
            
            EntityManager::class => \Roave\PsrContainerDoctrine\EntityManagerFactory::class,

            ExecuteCommand::class => CommandFactory::class,

            // Optionally, you could make your container aware of additional factories as of migrations release v3.0:
            ConfigurationLoader::class => ConfigurationLoaderFactory::class,
            DependencyFactory::class => DependencyFactoryFactory::class,
        ],
        'aliases' => [
            'doctrine.entity_manager.orm_default' => EntityManager::class
        ],
    ],
];
