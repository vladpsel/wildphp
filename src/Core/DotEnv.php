<?php

declare(strict_types=1);

namespace Voopsc\Wild\Core;

class DotEnv
{
    /**
     * Setup .env variables into environment
     * @param array|null $files
     * @return void|null
     * @throws CoreException
     */
    public function setEnvFiles(?array $files)
    {
        if (!$files || !is_array($files)) {
            return null;
        }

        foreach ($files as $file)
        {
            $env = ROOT . DIRECTORY_SEPARATOR . $file;
            if (file_exists($env)) {
                return $this->load($file);
            }
        }
    }

    /**
     * @throws CoreException
     */
    public function load($filename)
    {
        $env = ROOT . DIRECTORY_SEPARATOR. $filename;
        if (!file_exists($env)) {
            throw new CoreException('There is no file by this path:' . $env);
        }

        if (!is_readable($env)) {
            throw new CoreException('You have no permissions to read file');
        }

        $lines = file($env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
