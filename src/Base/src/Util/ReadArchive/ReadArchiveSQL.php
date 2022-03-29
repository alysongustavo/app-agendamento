<?php

declare(strict_types=1);

namespace Base\Util\ReadArchive;

use Base\Exception\SQLFileNotFoundException;
use Base\Util\Enum\StatusHttp;
use Exception;

class ReadArchiveSQL extends ReadArchive
{
    const PATH = "/../../../../../data/SQL/DML/";

    /**
     * Faz a leitura de um arquivo SQL
     * @param string $folder
     * @param string $fileName
     * @return false|string
     * @throws SQLFileNotFoundException
     */
    public function readArchive(string $folder, string $fileName)
    {
        try {
            return $this->openFile(self::PATH . $folder . "/" . $fileName . ".sql");
        } catch (Exception $e) {
            throw new SQLFileNotFoundException(
                StatusHttp::NOT_FOUND,
                "Arquivo " . $fileName . " não encontrado!",
                $e->getMessage());
        }
    }
}