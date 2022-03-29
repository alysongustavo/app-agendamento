<?php

declare(strict_types=1);

namespace Base\Service;

use Base\Entity\Category;
use Base\Exception\CategoryDatabaseException;
use Base\Exception\SQLFileNotFoundException;
use Base\Repository\CategoryRepository;

class PostCategoryService implements BaseServiceInterface
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
    public function insertCategory(Category $category): Category
    {
        return $this->categoryRepository->insertCategory($category);
    }
}