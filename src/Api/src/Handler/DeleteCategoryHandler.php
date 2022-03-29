<?php 

declare(strict_types=1);

namespace Api\Handler;

use Api\Service\Response\ApiResponse;
use Base\Exception\CategoryDatabaseException;
use Base\Exception\CategoryIdException;
use Base\Service\DeleteCategoryService;
use Base\Util\Enum\StatusHttp;
use Base\Util\Enum\SuccessMessage;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteCategoryHandler implements RequestHandlerInterface{

     /**
     * @var DeleteCategoryService
     */
    private $deleteCategoryService;

    public function __construct(
        DeleteCategoryService $deleteCategoryService
    ) {
        $this->deleteCategoryService = $deleteCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $categoryId = intval($request->getAttribute("id"));

            $this->deleteCategoryService->deleteCategory($categoryId);

            return new ApiResponse(
                sprintf(
                    SuccessMessage::DELETING_RECORD,
                    $categoryId
                ),
                StatusHttp::OK,
                ApiResponse::SUCCESS
            );
        } catch (CategoryDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (CategoryIdException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }

}