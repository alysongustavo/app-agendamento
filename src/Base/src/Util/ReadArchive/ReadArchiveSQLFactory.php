<?php

declare(strict_types=1);

namespace Base\Util\ReadArchive;

use Psr\Container\ContainerInterface;
use Base\Util\ReadArchive\ReadArchiveSQL;

class ReadArchiveSQLFactory
{
    public function __invoke(ContainerInterface $container): ReadArchiveSQL
    {
        return new ReadArchiveSQL();
    }
}