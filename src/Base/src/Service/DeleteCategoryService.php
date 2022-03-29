<?php

declare(strict_types=1);

namespace Base\Service;

use Base\Exception\CategoryDatabaseException;
use Base\Exception\CategoryIdException;
use Base\Repository\CategoryRepository;
use Base\Util\Enum\StatusHttp;
use Base\Util\Enum\ErrorMessage;

class DeleteCategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var GetCategoryService
     */
    private $getCategoryService;

    public function __construct(
        CategoryRepository $categoryRepository,
        GetCategoryService $getCategoryService
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->getCategoryService = $getCategoryService;
    }

    /**
     * @param int $categoryId
     * @throws CategoryIdException
     * @throws CategoryDatabaseException
     */
    public function deleteCategory(int $categoryId): void
    {
        $category = $this->getCategoryService->getCategoryById($categoryId);

        if($category) {
            $this->categoryRepository->deleteCategory($category);
        } else {
            throw new CategoryIdException(
                StatusHttp::NOT_FOUND,
                sprintf(
                    ErrorMessage::ERROR_REGISTER_NOT_FOUND,
                    $categoryId
                )
            );
        }
    }
}