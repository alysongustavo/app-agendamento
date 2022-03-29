<?php 

declare(strict_types=1);

namespace Api\Handler;

use Api\Service\Response\ApiResponse;
use Base\Exception\CategoryDatabaseException;
use Base\Service\GetCategoryService;
use Base\Util\Enum\StatusHttp;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetAllCategoryHandler implements RequestHandlerInterface{

     /**
     * @var GetCategoryService
     */
    private $getCategoryService;

    public function __construct(
        GetCategoryService $getCategoryService
    ) {
        $this->getCategoryService = $getCategoryService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $getCategories = $this->getCategoryService->getAllCategories();

            return new ApiResponse(
                $getCategories,
                StatusHttp::OK,
                ApiResponse::SUCCESS
            );
        } catch (CategoryDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }

}