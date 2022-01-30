<?php


namespace Voopsc\Wild\Component;

use Exception;
use Voopsc\Wild\Component\Session;
use Voopsc\Wild\Response\JSONData;
use Voopsc\Wild\Response\View;

class BaseController
{
    /**
     * @param string $templatePath
     * @param array|null $params
     * @return View
     * @throws Exception|Exception
     */
    public function render(string $templatePath, ?array $params = null): View
    {
        $view = new View($templatePath, $params);
        return $view->get();
    }

    protected function json($data, $code = null): JSONData
    {
        $jsonResponse = new JSONData();
        if (!empty($code)) {
            http_response_code($code);
        }
        return $jsonResponse->toJson($data);
    }

    public function getUser(): ?array
    {
        $session = new Session();

        try {
            if ($session->isKey('user')) {
                return $this->session->get('user');
            }
            return null;
        } catch (Exception $e) {
            return null;
        }
    }
}