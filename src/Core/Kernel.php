<?php

declare(strict_types=1);

namespace Voopsc\Wild\Core;

use Voopsc\Wild\Helper\ConfigExtractor;

class Kernel
{

    /**
     * @var void
     */
    private $mode;
    private DotEnv $env;
    private ConfigExtractor $config;
    private Routing $router;
    private Events $kernelEvents;

    /**
     * @throws CoreException
     */
    public function __construct()
    {
        $this->env = new DotEnv();
        $this->config = new ConfigExtractor();
        $this->router = new Routing();
        $this->kernelEvents = new Events();
        $this->setEnvVariables();
        $this->mode = $this->getMode();
    }

    public function run()
    {
//        TODO: Add exception handler (with default view file for each type of error)
        try {
            $langSupport = $this->config->getConfigParam('multilingual');
            if ($langSupport) {
                $coreLanguages = new CoreLanguages();
                $coreLanguages->setUrl($this->router->getURI())->allowMultilingual();
            }
            return $this->kernelEvents->callController($this->router);
        } catch (CoreException $e) {
            $errorHandler = new ExceptionHandler();
            $errorHandler->handleException($e);
        }
    }

    /**
     * Get application mode like
     * development / test / production / etc.
     * @return string
     */
    private function getMode(): string
    {
        return getenv('APP_ENV');
    }

    /**
     *
     * @throws CoreException
     */
    private function setEnvVariables(): ?bool
    {
        $this->env->setEnvFiles(['.env', '.env.test', '.env.dist', '.env.local']);
        return true;
    }
    
}
