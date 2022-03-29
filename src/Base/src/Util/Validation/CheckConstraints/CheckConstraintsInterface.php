<?php

declare(strict_types=1);

namespace Base\Util\Validation\CheckConstraints;

use Base\Entity\BaseEntityInterface;

interface CheckConstraintsInterface
{
    /**
     * @param BaseEntityInterface|null $entity
     * @param string|null $messageError
     */
    public static function checkBaseEntity(?BaseEntityInterface $entity, ?string $messageError = null): void;

    /**
     * @param array $constraints
     */
    public static function checkBaseEntityConstraints(array $constraints): void;
}