<?php

declare(strict_types=1);

namespace Api\Handler;

use Base\Service\GetCategoryService;
use Psr\Container\ContainerInterface;

class GetAllCategoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetAllCategoryHandler
    {
        $getCategory = $container->get(GetCategoryService::class);
        return new GetAllCategoryHandler($getCategory);
    }
}