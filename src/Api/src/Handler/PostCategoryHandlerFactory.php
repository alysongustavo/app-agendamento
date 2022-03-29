<?php

declare(strict_types=1);

namespace Api\Handler;

use Base\Service\PostCategoryService;
use Psr\Container\ContainerInterface;

class PostCategoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): PostCategoryHandler
    {
        $getCategory = $container->get(PostCategoryService::class);
        return new PostCategoryHandler(
            $getCategory
        );
    }
}