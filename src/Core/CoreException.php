<?php

declare(strict_types=1);

namespace Voopsc\Wild\Core;

use Exception;
use Throwable;

class CoreException extends Exception
{

    private string|false $mode;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->mode = ini_get('display_errors');
    }

}
