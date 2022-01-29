<?php

declare(strict_types=1);

namespace Voopsc\Wild\Component;

use Exception;

class Session
{

    /**
     * Checks if there is existed session
     * @return bool
     */
    public function isSession(): bool
    {
        if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            return false;
        }
        return true;
    }

    /**
     * Start session if it doesn't exist
     * @return bool
     */
    public function startSession(): bool
    {
        if (!$this->isSession()) {
            session_start();
            return true;
        }
        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isKey(string $key): bool
    {
        if (!isset($_SESSION[$key]) || empty($_SESSION[$key]) || $_SESSION[$key] === '') {
            return false;
        }
        return true;
    }

    /**
     * @param string $key
     * @param bool $onlyValue
     * @return mixed
     */
    public function get(string $key, bool $onlyValue = false): mixed
    {
        if ($onlyValue) {
            return implode('', $_SESSION[$key]);
        }
        return $_SESSION[$key];
    }

    /**
     * @param array $param
     * @return array
     * @throws Exception
     */
    public function set(array $param): array
    {
        if (!$this->isSession()) {
            throw new Exception('There is no exist session');
        }
        return $_SESSION[key($param)] = $param;
    }

}