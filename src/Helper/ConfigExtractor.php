<?php

declare(strict_types=1);

namespace Voopsc\Wild\Helper;

use Voopsc\Wild\Core\CoreException;

class ConfigExtractor
{

    private const CONFIG_DIR = ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;

    private const DEFAULT_CONFIG = self::CONFIG_DIR . 'config.wild.php';


    /**
     * Get data from config file
     * @param string $filename
     * @return mixed
     * @throws CoreException
     */
    public function getConfigFile(string $filename = self::DEFAULT_CONFIG): mixed
    {
        if (!file_exists($filename)) {
            throw new CoreException('There is no config file');
        }
        return include $filename;
    }

    /**
     * @param string $key
     * @param string|null $configFile
     * @return mixed
     * @throws CoreException
     */
    public function getConfigParam(string $key, ?string $configFile = self::DEFAULT_CONFIG): mixed
    {
        if (empty($configFile) || $configFile == '') {
            throw new CoreException($configFile . 'must not bee empty or null');
        }
        $data = $this->getConfigFile($configFile);

        if (!array_key_exists($key, $data)) {
            throw new CoreException('There is no setting with key: ' . "$key");
        }

        return $data[$key];
    }

    /**
     * @throws CoreException
     */
    public function checkConfigParam(?string $key, ?string $configFile = self::DEFAULT_CONFIG): ?array
    {
        if (empty($configFile) || $configFile == '') {
            throw new CoreException($configFile . 'must not bee empty or null');
        }
        $data = $this->getConfigFile($configFile);
        if (!array_key_exists($key, $data)) {
            return null;
        }

        return $data[$key];
    }

    public function getConfigDirPath(): string
    {
        return self::CONFIG_DIR;
    }

}