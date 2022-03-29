<?php

declare(strict_types=1);

namespace Base\Service;

use Base\Dto\CategoryDto;
use Base\Entity\Category;
use Base\Exception\CategoryDatabaseException;
use Base\Exception\SQLFileNotFoundException;
use Base\Repository\CategoryRepository;

class GetCategoryService implements BaseServiceInterface
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
     * @param int $cityId
     * @return Category|null
     * @throws CategoryDatabaseException
     */
    public function getCategoryById(int $categoryId): ?Category
    {
        return $this->categoryRepository->findByCategoryId($categoryId);
    }

    /**
     * @return array|null
     * @throws CategoryDatabaseException
     */
    public function getAllCategories(): ?array
    {
        $allCategories = $this->categoryRepository->findAllCategories();

        $allCategoryResult = [];
        foreach ($allCategories as $key => $value) {
            $categoryDto = new CategoryDto();
            $categoryDto->setId($value->getId());
            $categoryDto->setName($value->getName());
            $categoryDto->setDescription($value->getDescription());
            array_push($allCategoryResult, $categoryDto);
        }

        return $allCategoryResult;
    }

    /**
     * @param string $name
     * @return array|null
     * @throws CategoryDatabaseException
     * @throws SQLFileNotFoundException
     */
    public function getCategoryByName(string $name): ?array
    {
        return $this->categoryRepository->findCategoryByName($name);
    }
}