<?php

namespace Voopsc\Wild\Component;

use Voopsc\Wild\Core\CoreException;
use Voopsc\Wild\Helper\ConfigExtractor;
use Voopsc\Wild\Response\View;

class MetaData
{

    private View $renderComponent;
    private ConfigExtractor $config;
    private ?array $metaComponents;

    /**
     * @throws CoreException
     */
    public function __construct()
    {
        $this->config = new ConfigExtractor();
        $this->metaComponents = $this->setMetaComponents();
    }

    /**
     * @throws CoreException
     */
    public function getHead()
    {
        if (!array_key_exists('head', $this->metaComponents)) {
            return null;
        }

        $headTemplate = $this->metaComponents['head']['template'];
        $headData = $this->metaComponents['head']['dataExtractor'];
        if (empty($headData)) {
            return null;
        }
        $dataExtractor = new $headData();

        $this->checkExtractorType($dataExtractor);

        $renderComponent = new View($headTemplate, $dataExtractor->getMetaData());
        return $renderComponent->get();

    }


    /**
     * @throws CoreException
     */
    private function setMetaComponents(): ?array
    {
        return $this->config->checkConfigParam('templates');
    }

    /**
     * @throws CoreException
     */
    private function checkExtractorType(object $dataExtractor)
    {
        if (!method_exists($dataExtractor, 'getMetaData')) {
            throw new CoreException('no required method');
        }
        return null;
    }
    
}