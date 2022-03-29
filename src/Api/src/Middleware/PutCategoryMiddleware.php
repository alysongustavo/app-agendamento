<?php 

declare(strict_types=1);

namespace Api\Middleware;

use Api\Service\Response\ApiResponse;
use Base\Entity\Category;
use Base\Exception\CategoryDatabaseException;
use Base\Exception\CategoryIdException;
use Base\Service\GetCategoryService;
use Base\Util\Enum\ErrorMessage;
use Base\Util\Enum\StatusHttp;
use Base\Util\Serialize\SerializeUtil;
use Base\Util\Validation\CheckConstraints\Exception\BaseEntityException;
use Base\Util\Validation\CheckConstraints\Exception\BaseEntityViolationsException;
use Base\Util\Validation\ValidationService;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PutCategoryMiddleware implements MiddlewareInterface{

     /**
     * @var SerializeUtil
     */
    private $serialize;

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * @var GetCategoryService
     */
    private $getCategoryService;

    public function __construct(
        SerializeUtil $serialize,
        ValidationService $validationService,
        GetCategoryService $getCategoryService
    ) {
        $this->serialize = $serialize;
        $this->validationService = $validationService;
        $this->getCategoryService = $getCategoryService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $category = $this->serialize->deserialize(
                $request->getBody()->getContents(),
                Category::class,
                'json'
            );

            $categoryId = intval($request->getAttribute('id'));
            
            $categoryFind = $this->getCategoryService->getCategoryById($categoryId);

            //var_dump($categoryFind);die();

            if (!$categoryFind) {
                throw new CategoryIdException(
                    StatusHttp::NOT_FOUND,
                    sprintf(
                        ErrorMessage::ERROR_REGISTER_NOT_FOUND,
                        $categoryId
                    )
                );
            }

            $this->validationService->validateEntity($category, ['update']);
            $category->setId($categoryFind->getId());
            $category->setName(strtoupper($category->getName()));
            $category->setDescription(strtoupper($category->getDescription()));
        } catch (BaseEntityException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (BaseEntityViolationsException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (CategoryDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (CategoryIdException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
        return $handler->handle($request->withAttribute('putCategory', $category));
    }

}