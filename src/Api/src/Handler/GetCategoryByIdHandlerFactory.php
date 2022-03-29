<?php

declare(strict_types=1);

namespace Api\Handler;

use Api\Handler\GetCategoryByIdHandler;
use Base\Service\GetCategoryService;
use Psr\Container\ContainerInterface;

class GetCategoryByIdHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetCategoryByIdHandler
    {
        $getCategory = $container->get(GetCategoryService::class);
        return new GetCategoryByIdHandler(
            $getCategory
        );
    }
}