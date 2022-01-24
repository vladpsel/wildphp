<?php

declare(strict_types=1);

namespace Voopsc\Wild\Core;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Events
{

    /**
     * @param Routing $router
     * @return mixed
     * @throws CoreException
     */
    public function callController(Routing $router): mixed
    {
        $controllerData = $this->prepareControllerAction($router);
        $controller = $this->getControllerObject($controllerData);
        $params = $controllerData['params'];


        return call_user_func_array([
            $controller,
            $controllerData['actionName'],
        ], $params);
    }


    /**
     * @param Routing $router
     * @return array
     * @throws CoreException
     */
    private function prepareControllerAction(Routing $router): array
    {
        $url = $router->getURI();
        $params = $router->getControllerParams();

        if (empty($params)) {
            throw new CoreException('There is no route or controller/action parameter for ' . "$url url");
        }

        $pattern = $params['pattern'];

        $stringRoute = preg_replace("~$pattern~i", $params['controllerAction'], $url);
        $segments = explode('/', $stringRoute);

        return [
            'controllerName' => ucfirst(array_shift($segments).'Controller'),
            'actionName' => array_shift($segments),
            'params' => $segments
        ];
    }

    /**
     * @param array $controllerData
     * @return mixed
     * @throws CoreException
     */
    private function getControllerObject(array $controllerData): object
    {
        $controllerList = $this->getControllerObjects($controllerData['controllerName']);

        if (empty($controllerList)) {
            throw new CoreException("There is no controller " . $controllerData['controllerName']);
        }

        return $this->getController($controllerList, $controllerData['actionName']);
    }

    /**
     * Return all controllers which matches controller route
     * @param string $controllerName
     * @return array|null
     * @throws CoreException
     */
    private function getControllerObjects(string $controllerName): ?array
    {

        $directory = implode(DIRECTORY_SEPARATOR, [
            ROOT,
            'src',
            'Controller'
        ]);

        if (!file_exists($directory)) {
            throw new CoreException('There is no controller directory');
        }


        $matchObjects = null;
        $i = 0;

        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory), RecursiveIteratorIterator::SELF_FIRST);
        foreach($objects as $object ){
            if ($object->getFilename() === $controllerName . '.php') {
                $matchObjects[$i] = $object->getRealPath();
                $i++;
            }
        }

        return $matchObjects;
    }

    /**
     * @throws CoreException
     */
    private function getController(?array $controllerObjects, string $action): object
    {
        if (empty($controllerObjects)) {
            throw new CoreException('There is no controller file');
        }

        $namespace = trim($this->getMainNamespace(), '\\');



        foreach ($controllerObjects as $controller) {
            $pattern = ROOT . '/';
            $controllerFile = preg_replace("~$pattern~", '', $controller);
            $controllerFile = preg_replace('~src~i', $namespace, $controllerFile);
            $controllerFile = preg_replace("~/~", '\\', $controllerFile);
            $controllerFile = trim($controllerFile, '.php');
            $object = new $controllerFile;

            if (method_exists($object, $action)) {
                return $object;
            }
        }

        throw new CoreException('There is no ' . $action . ' method in controller');
    }

    public function getMainNamespace()
    {
        $composer = file_get_contents(ROOT . '/composer.json');
        $data = json_decode($composer, true);
        $psr = $data['autoload']['psr-4'];
        return key($psr);
    }

}
