<?php

declare(strict_types=1);

namespace Base\Service;

use Base\Entity\Category;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class DeleteCategoryServiceFactory
{
    public function __invoke(ContainerInterface $container): DeleteCategoryService
    {
        $entityManager = $container->get(EntityManager::class);
        $categoryRepository = $entityManager->getRepository(Category::class);
        $getCategoryService = $container->get(GetCategoryService::class);
        return new DeleteCategoryService(
            $categoryRepository,
            $getCategoryService
        );
    }
}