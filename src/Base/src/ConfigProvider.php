<?php

declare (strict_types=1);

namespace Base;

use Base\Container\CorsFactory;
use Base\Container\JMSFactory;
use Base\Container\ValidationFactory;
use Base\Service\DeleteCategoryService;
use Base\Service\DeleteCategoryServiceFactory;
use Base\Service\GetCategoryService;
use Base\Service\GetCategoryServiceFactory;
use Base\Service\PostCategoryService;
use Base\Service\PostCategoryServiceFactory;
use Base\Service\PutCategoryService;
use Base\Service\PutCategoryServiceFactory;
use Base\Util\ReadArchive\ReadArchiveSQL;
use Base\Util\ReadArchive\ReadArchiveSQLFactory;
use Base\Util\Serialize\SerializeUtil;
use Base\Util\Serialize\SerializeUtilFactory;
use Base\Util\Validation\ValidationService;
use Base\Util\Validation\ValidationServiceFactory;
use Symfony\Component\Validator\Validation;
use Tuupola\Middleware\CorsMiddleware;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
            
            ],
            'factories'  => [

                # Category
                # Service
                DeleteCategoryService::class => DeleteCategoryServiceFactory::class,
                GetCategoryService::class => GetCategoryServiceFactory::class,
                PostCategoryService::class => PostCategoryServiceFactory::class,
                PutCategoryService::class => PutCategoryServiceFactory::class,

                'serializer' => JMSFactory::class,
                CorsMiddleware::class => CorsFactory::class,
                SerializeUtil::class => SerializeUtilFactory::class,
                ValidationService::class => ValidationServiceFactory::class,
                Validation::class => ValidationFactory::class,
                ReadArchiveSQL::class => ReadArchiveSQLFactory::class,
            
            ],
        ];
    }

   

}