<?php 

declare(strict_types=1);

namespace Api\Handler;

use Api\Service\Response\ApiResponse;
use Base\Exception\CategoryDatabaseException;
use Base\Exception\CategoryIdException;
use Base\Service\GetCategoryService;
use Base\Util\Enum\ErrorMessage;
use Base\Util\Enum\StatusHttp;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetCategoryByIdHandler implements RequestHandlerInterface{

      /**
     * @var GetCategoryService
     */
    private $getCityService;

    public function __construct(
        GetCategoryService $getCategoryService
    ) {
        $this->getCategoryService = $getCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $categoryId = intval($request->getAttribute("id"));

            $getCategory = $this->getCategoryService->getCategoryById(
                $categoryId
            );

            if (!$categoryId) {
                throw new CategoryIdException(
                    StatusHttp::NOT_FOUND,
                    sprintf(
                        ErrorMessage::ERROR_REGISTER_NOT_FOUND,
                        $categoryId
                    )
                );
            }

            return new ApiResponse(
                $getCategory,
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