<?php 

declare(strict_types=1);

namespace Api\Handler;

use Api\Service\Response\ApiResponse;
use Base\Exception\CategoryDatabaseException;
use Base\Service\PostCategoryService;
use Base\Util\Enum\StatusHttp;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PostCategoryHandler implements RequestHandlerInterface{

    /**
     * @var PostCategoryService
     */
    private $postCategoryService;

    public function __construct(
        PostCategoryService $postCategoryService
    ) {
        $this->postCategoryService = $postCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->postCategoryService->insertCategory(
                $request->getAttribute('postCategory')
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