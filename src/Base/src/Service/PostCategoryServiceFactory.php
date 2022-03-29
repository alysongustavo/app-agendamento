<?php

declare(strict_types=1);

namespace Base\Service;

use Base\Entity\Category;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class PostCategoryServiceFactory
{
    public function __invoke(ContainerInterface $container): PostCategoryService
    {
        $entityManager = $container->get(EntityManager::class);
        $categoryRepository = $entityManager->getRepository(Category::class);
        return new PostCategoryService(
            $categoryRepository
        );
    }
}