<?php

declare(strict_types=1);

namespace Api\Middleware;

use Base\Util\Serialize\SerializeUtil;
use Psr\Container\ContainerInterface;
use Base\Util\Validation\ValidationService;
use Base\Service\GetCategoryService;

class PutCategoryMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PutCategoryMiddleware
    {
        $serialize = $container->get(SerializeUtil::class);
        $validationService = $container->get(ValidationService::class);
        $getCategoryService = $container->get(GetCategoryService::class);
        return new PutCategoryMiddleware(
            $serialize,
            $validationService,
            $getCategoryService
        );
    }
}