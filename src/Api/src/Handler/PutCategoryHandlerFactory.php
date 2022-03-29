<?php

declare(strict_types=1);

namespace Api\Handler;

use Base\Service\PutCategoryService;
use Psr\Container\ContainerInterface;

class PutCategoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): PutCategoryHandler
    {
        $getCategory = $container->get(PutCategoryService::class);
        return new PutCategoryHandler(
            $getCategory
        );
    }
}