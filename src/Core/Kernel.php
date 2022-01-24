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
        $this->mode = $this->getMode();
        $this->config = new ConfigExtractor();
        $this->router = new Routing();
        $this->kernelEvents = new Events();
        $this->setEnvVariables();
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
            print_r($e->getMessage());
        }
    }

    /**
     * Get application mode like
     * development / test / production / etc.
     * @return string
     */
    private function getMode(): string
    {
//        TODO: refactor .env app_env variable
        return 'dev';
    }

    /**
     *
     * @throws CoreException
     */
    private function setEnvVariables(): ?bool
    {
        switch ($this->mode) {
            case 'dev': $this->env->setEnvFiles(['.env.local', '.env.dist']); return true;
            case 'test': $this->env->load('.env.test'); return true;
            case 'prod': $this->env->load('.env'); return true;
        }
        return null;
    }
    
}
