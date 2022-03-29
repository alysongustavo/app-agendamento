<?php 

declare(strict_types=1);

namespace Base\Util\Validation;

use Base\Entity\BaseEntityInterface;

interface ValidationServiceInterface{

    /**
     * validateEntity
     * @param  BaseEntityInterface $entity
     * @param  mixed $messageError
     *
     * @return void
     */
    public function validateEntity(?BaseEntityInterface $entity, ?array $groups = null, ?string $messageError = null): void;

}