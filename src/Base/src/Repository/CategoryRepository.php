<?php

namespace Base\Repository;

use Base\Entity\Category;
use Doctrine\ORM\EntityRepository;

use Exception;
use Base\Util\Enum\StatusHttp;
use Base\Util\Enum\ErrorMessage;
use Doctrine\ORM\Query\ResultSetMapping;
use Base\Util\ReadArchive\ReadArchiveSQL;
use Base\Exception\SQLFileNotFoundException;
use Base\Exception\CategoryDatabaseException;

class CategoryRepository extends EntityRepository{

     /**
     * @var ResultSetMapping
     */
    private $resultSetMapping;

    /**
     * @var ReadArchiveSQL
     */
    private $readSQL;

    private function setInstance(): void
    {
        $this->resultSetMapping = new ResultSetMapping();
        $this->readSQL = new ReadArchiveSQL();
    }

    /**
     * @param Category $category
     * @return Category
     * @throws CategoryDatabaseException
     */
    public function insertCategory(Category $category): Category
    {
        try {
            $this->getEntityManager()->persist($category);
            $this->getEntityManager()->flush();
            return $category;
        } catch (Exception $e) {
            throw new CategoryDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_INSERTING_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param Category $category
     * @return Category
     * @throws CategoryDatabaseException
     */
    public function updateCategory(Category $category): Category
    {
        try {
            $this->getEntityManager()->merge($category);
            $this->getEntityManager()->flush();
            return $category;
        } catch (Exception $e) {
            throw new CategoryDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_REGISTRY_CHANGE,
                $e->getMessage()
            );
        }
    }

    /**
     * @param Category $category
     * @throws CategoryDatabaseException
     */
    public function deleteCategory(Category $category): void
    {
        try {
            $this->getEntityManager()->remove($category);
            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            throw new CategoryDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_DELETING_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param int $categoryId
     * @return Category|null
     * @throws CategoryDatabaseException
     */
    public function findByCategoryId(int $categoryId): ?Category
    {
        try {
            return $this->getEntityManager()->getRepository(Category::class)
                ->findOneBy(['id' => $categoryId]);
        } catch (Exception $e) {
            throw new CategoryDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_A_RECORD . "id " . $categoryId,
                $e->getMessage()
            );
        }
    }

    /**
     * @return array|null
     * @throws CategoryDatabaseException
     */
    public function findAllCategories(): ?array
    {
        try {
            return $this->getEntityManager()->getRepository(Category::class)->findAll();
        } catch (Exception $e) {
            throw new CategoryDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_ALL_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * @param string $name
     * @return array|null
     * @throws CategoryDatabaseException
     * @throws SQLFileNotFoundException
     */
    public function findCategoryByName(string $name): ?array
    {
        try {
            $this->setInstance();
            $this->resultSetMapping->addScalarResult('id', 'id');
            $this->resultSetMapping->addScalarResult('name', 'name');
            $this->resultSetMapping->addScalarResult('description', 'description');
            $sql = $this->readSQL->readArchive('Category', 'SELECT_CATEGORY_BY_NAME');
            $query = $this->getEntityManager()->createNativeQuery($sql, $this->resultSetMapping);
            $query->setParameter('name', $name);
            return $query->getOneOrNullResult();
        } catch (SQLFileNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new CategoryDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                "Ocorreu um erro ao buscar dados da categoria!",
                $e->getMessage()
            );
        }
    }
    
}