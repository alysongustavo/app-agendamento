<?php

declare(strict_types=1);

namespace Api\Handler;

use Api\Handler\DeleteCategoryHandler;
use Base\Service\DeleteCategoryService;
use Psr\Container\ContainerInterface;

class DeleteCategoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeleteCategoryHandler
    {
        $deleteCategoryService = $container->get(DeleteCategoryService::class);
        return new DeleteCategoryHandler(
            $deleteCategoryService
        );
    }
}