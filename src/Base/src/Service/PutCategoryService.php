<?php

declare(strict_types=1);

namespace Base\Service;

use Base\Entity\Category;
use Base\Exception\CategoryDatabaseException;
use Base\Repository\CategoryRepository;

class PutCategoryService implements BaseServiceInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Category $category
     * @return Category
     * @throws CategoryDatabaseException
     */
    public function updateCategory(Category $category): Category
    {

        $databaseCategory = $this->categoryRepository->findByCategoryId($category->getId());

        $databaseCategory->setName(strtoupper($category->getName()));
        $databaseCategory->setDescription($category->getDescription());

        return $this->categoryRepository->updateCategory($databaseCategory);
    }
}