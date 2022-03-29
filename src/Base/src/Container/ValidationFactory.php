<?php

declare(strict_types=1);

namespace Base\Container;

use Interop\Container\ContainerInterface;
use Symfony\Component\Validator\Validation;

class ValidationFactory
{
    public function __invoke()
    {
        $validator = Validation::createValidatorBuilder()
        ->enableAnnotationMapping()->getValidator();
        return $validator;
    }
}