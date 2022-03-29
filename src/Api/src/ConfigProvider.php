<?php

namespace Api;

use Api\Handler\DeleteCategoryHandler;
use Api\Handler\DeleteCategoryHandlerFactory;
use Api\Handler\GetAllCategoryHandler;
use Api\Handler\GetAllCategoryHandlerFactory;
use Api\Handler\GetCategoryByIdHandler;
use Api\Handler\GetCategoryByIdHandlerFactory;
use Api\Handler\PostCategoryHandler;
use Api\Handler\PostCategoryHandlerFactory;
use Api\Handler\PutCategoryHandler;
use Api\Handler\PutCategoryHandlerFactory;
use Api\Middleware\PostCategoryMiddleware;
use Api\Middleware\PostCategoryMiddlewareFactory;
use Api\Middleware\PutCategoryMiddleware;
use Api\Middleware\PutCategoryMiddlewareFactory;
use Mezzio\Application;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [RoutesDelegator::class]
            ],
            'invokables' => [
                // Invokables
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [

                # Categories
                # Handler
                DeleteCategoryHandler::class => DeleteCategoryHandlerFactory::class,
                GetAllCategoryHandler::class => GetAllCategoryHandlerFactory::class,
                GetCategoryByIdHandler::class => GetCategoryByIdHandlerFactory::class,
                PostCategoryHandler::class => PostCategoryHandlerFactory::class,
                PutCategoryHandler::class => PutCategoryHandlerFactory::class,

                 # Middleware
                 PostCategoryMiddleware::class => PostCategoryMiddlewareFactory::class,
                 PutCategoryMiddleware::class => PutCategoryMiddlewareFactory::class,
            ],
        ];
    }

   

}