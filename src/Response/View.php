<?php

declare(strict_types=1);

namespace Voopsc\Wild\Response;

use Exception;
use Voopsc\Wild\Component\MetaData;
use Voopsc\Wild\Core\CoreException;

class View
{
    public const DEFAULT_TEMPLATE_DIR = ROOT . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;
    private string $template;
    private ?array $data;
    private MetaData $components;

    public function __construct(string $templatePath = '', ?array $data = null)
    {
        $this->template = $templatePath;
        $this->data = $data;

        $this->components = new MetaData();
    }


    /**
     * @throws Exception
     */
    public function get(): self
    {
        $this->checkTemplateExist();
        $this->checkAllowedFormat();

        if ($this->validData()) {
            foreach ($this->data as $key => $item) {
                if (is_array($item)) {
                    extract($item);
                } else {
                    extract([$key => $item]);
                }
            }
        }
        $view = ob_start();
        include_once self::DEFAULT_TEMPLATE_DIR . $this->template;
        ob_get_flush();
        return $this;
    }

    /**
     * @throws CoreException
     */
    public function getTemplatePart(?string $tplName, ?array $tplData = []): bool
    {
        if (empty($tplName)) {
            throw new CoreException('There is no template part ');
        }

        $file = self::DEFAULT_TEMPLATE_DIR . $tplName . '.php';
        if (!file_exists($file)) {
            throw new CoreException('There is no template part');
        }

        $view = ob_start();
        include $file;
        ob_get_flush();
        return $view;

    }


    /**
     * @return Exception|null
     * @throws Exception
     */
    private function checkTemplateExist(): ?CoreException
    {
        $file = self::DEFAULT_TEMPLATE_DIR . $this->template;
        if (!file_exists($file)) {
            throw new CoreException('There is no template by path ' . $file);
        }
        return null;
    }

    /**
     * @return Exception|null
     * @throws Exception
     */
    private function checkAllowedFormat(): ?CoreException
    {
        if (!preg_match('~^([a-zA-Z0-9_/]+)\.php$~', $this->template)) {
            throw new Exception('Not allowed filename or extension in ' . $this->template);
        }
        return null;
    }

    /**
     * @return Exception|null
     * @throws Exception
     */
    private function validData(): ?bool
    {
        if (!$this->data) {
            return false;
        }

        if (!is_array($this->data) && empty($this->data)) {
            throw new Exception('There is no/empty array data ' . $this->data);
        }
        return true;
    }


}
