<?php

declare(strict_types=1);

namespace Voopsc\Wild\Core;

use Exception;
use Voopsc\Wild\Component\BaseController;
use Voopsc\Wild\Helper\ConfigExtractor;
use Voopsc\Wild\Response\View;


class ExceptionHandler
{

    private View $response;
    private ConfigExtractor $config;

    public function __construct()
    {
        $this->response = new View();
        $this->config = new ConfigExtractor();
    }

    public function handleException(Exception $e)
    {
        if ($this->isDev()) {
            die($e);
        }

        $this->processProdError($e);
    }

    /**
     * Check mode state
     * @return bool
     */
    private function isDev()
    {
        $mode = getenv('APP_ENV');
        if ($mode === 'dev') {
            return true;
        }
        return false;
    }

    /**
     * @throws CoreException
     */
    private function processProdError(Exception $e)
    {
        $errors = $this->config->getConfigParam('errorHandler');
        $code = $this->getCode($e);

        $errorFile = $this->response::DEFAULT_TEMPLATE_DIR . $errors[$code] . '.php';

        if (!file_exists($errorFile)) {
            die($e);
        }

        $request = trim($_SERVER['REQUEST_URI'], '/');

        if ($request !== '404') {
            header("Location: /404");
        }

        return $this->response->getTemplatePart($errors[$code]);
    }

    /**
     * @param Exception $e
     * @return int
     */
    private function getCode(Exception $e): int
    {
        $code = $e->getCode();
        if (empty($code)) {
            return 404;
        }
        return $code;
    }
}
