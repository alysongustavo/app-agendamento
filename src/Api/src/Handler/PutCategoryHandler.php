<?php 

declare(strict_types=1);

namespace Api\Handler;

use Api\Service\Response\ApiResponse;
use Base\Exception\CategoryDatabaseException;
use Base\Service\PutCategoryService;
use Base\Util\Enum\StatusHttp;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PutCategoryHandler implements RequestHandlerInterface{

   /**
     * @var PutCategoryService
     */
    private $putCategoryService;

    public function __construct(
        PutCategoryService $putCategoryService
    ) {
        $this->putCategoryService = $putCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->putCategoryService->updateCategory(
                $request->getAttribute('putCategory')
            );

            return new ApiResponse(
                $response,
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