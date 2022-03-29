<?php

declare(strict_types=1);

namespace Base\Util\Serialize;

use Psr\Container\ContainerInterface;
use Base\Util\Serialize\SerializeUtil;

class SerializeUtilFactory
{
    public function __invoke(ContainerInterface $container): SerializeUtil
    {
        $jms = $container->get('serializer');
        return new SerializeUtil($jms);
    }
}