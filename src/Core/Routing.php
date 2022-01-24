<?php

declare(strict_types=1);

namespace Voopsc\Wild\Core;

class Routing
{

    private const CONFIG_DIR = ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;

    /**
     * @return array|null
     * @throws CoreException
     */
    public function getControllerParams(): ?array
    {
        return $this->getControllerActionName();
    }

    /**
     * Get uri as string
     * @return string
     */
    public function getURI(): string
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        if (preg_match('/\?/', $uri)) {
            $uriParts = explode('?', $uri);
            array_pop($uriParts);
            $uri = implode('/', $uriParts);
        }
        return trim($uri, '/');
    }

    /**
     * Get array with router rules (routes)
     * in format controller/action
     * @return array|null
     * @throws CoreException
     */
    private function getRoutesArray(): ?array
    {
        $routesFilepath = self::CONFIG_DIR . 'routes.php';

        if (!file_exists($routesFilepath)) {
            throw new CoreException('There is no router file');
        }

        $routes = include_once $routesFilepath;

        if (empty($routes) || !is_array($routes)) {
            return null;
        }

        return $routes;
    }


    /**
     * Matches uri with router rules.
     * If uri exist return params
     * @return array|null
     * @throws CoreException
     */
    private function getControllerActionName(): ?array
    {
        try {

            $uri = $this->getURI();
            $routes = $this->getRoutesArray();

            if (empty($routes)) {
                throw new CoreException('Empty routes');
            }

            foreach ($routes as $uriPattern => $controllerAction) {

                if (preg_match("~$uriPattern~iu", $uri)) {
                    return [
                        'pattern' => $uriPattern,
                        'controllerAction' => $controllerAction
                    ];
                }
            }
            return null;
        } catch (CoreException $e) {
            throw new CoreException($e->getMessage());
        }
    }

}