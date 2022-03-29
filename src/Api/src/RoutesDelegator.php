<?php

declare(strict_types=1);

namespace Api;

use Api\Handler\DeleteCategoryHandler;
use Api\Handler\GetAllCategoryHandler;
use Api\Handler\GetCategoryByIdHandler;
use Api\Handler\PostCategoryHandler;
use Api\Handler\PutCategoryHandler;
use Api\Middleware\PostCategoryMiddleware;
use Api\Middleware\PutCategoryMiddleware;
use Mezzio\Application;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    /**
     * @param ContainerInterface $container
     * @param string $serviceName
     * @param callable $callback
     * @return Application
     */
    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): Application
    {
        /**
         * @var Application $app
         */
        $app = $callback();

        $app->post("/v1/category", [
            PostCategoryMiddleware::class,
            PostCategoryHandler::class,
        ], "post.category");

        $app->put("/v1/category/{id:\d+}", [
            PutCategoryMiddleware::class,
            PutCategoryHandler::class,
        ], "put.category");

        $app->delete("/v1/category/{id:\d+}", [
            DeleteCategoryHandler::class,
        ], "delete.category");

        $app->get("/v1/categories", [
            GetAllCategoryHandler::class,
        ], "get.all_categories");

        $app->get("/v1/category/{id:\d+}", [
            GetCategoryByIdHandler::class,
        ], "get.category_byid");

        return $app;
    }
}