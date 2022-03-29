<?php

declare(strict_types=1);

namespace Base\Service;

use Base\Entity\Category;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class PutCategoryServiceFactory
{
    public function __invoke(ContainerInterface $container): PutCategoryService
    {
        $entityManager = $container->get(EntityManager::class);
        $categoryRepository = $entityManager->getRepository(Category::class);
        return new PutCategoryService(
            $categoryRepository
        );
    }
}