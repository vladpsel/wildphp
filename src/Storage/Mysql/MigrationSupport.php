<?php

declare(strict_types=1);

namespace Voopsc\Wild\Storage\Mysql;

use Exception;

class MigrationSupport extends Connection
{

    private const MIGRATIONS_DIR = ROOT . 'migrations' . DIRECTORY_SEPARATOR;

    /**
     * @throws Exception
     */
    public function migrate(?string $migrationFile)
    {
        if (!file_exists(self::MIGRATIONS_DIR . $migrationFile) || empty($migrationFile)) {
            throw new Exception();
        }

        $migrationFile = include_once self::MIGRATIONS_DIR . $migrationFile;

        var_dump($migrationFile);
    }


}