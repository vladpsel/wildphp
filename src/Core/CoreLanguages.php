<?php

declare(strict_types=1);

namespace Voopsc\Wild\Core;

use Voopsc\Wild\Helper\ConfigExtractor;

class CoreLanguages
{

    private const DEFAULT_LANG_KEY = 'defaultLang';
    private const LANG_CONFIG_FILE = ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'allowed.lang.php';
    private const LANG_DICTIONARY_FILE = ROOT . DIRECTORY_SEPARATOR . 'translation' . DIRECTORY_SEPARATOR;

    /**
     * @var string|null
     */
    private ?string $url;
    /**
     * @var string|null
     */
    private ?string $defaultLang;
    private ConfigExtractor $config;
    private mixed $configParams;
    private mixed $allowedLangs;

    /**
     * @throws CoreException
     */
    public function __construct()
    {
        $this->config = new ConfigExtractor();
        $this->configParams = $this->config->getConfigFile();
        $this->allowedLangs = $this->config->getConfigFile(self::LANG_CONFIG_FILE);
        $this->defaultLang = $this->setDefaultLang();
        $this->url = null;
    }

    /**
     * @throws CoreException
     */
    public function allowMultilingual()
    {
        $lang = $this->validateLangUrl();
        $this->includeDictionary($lang);
        $this->setupAppLang($lang);
    }

    /**
     * @param string|null $url
     * @return $this
     * @throws CoreException
     */
    public function setUrl(?string $url): self
    {
        if (empty($url) && $url !== '') {
            throw new CoreException('There is empty url');
        }

        $this->url = $url;
        return $this;
    }

    /**
     * @throws CoreException
     */
    private function validateLangUrl()
    {
        if ($this->url === '') {
            return $this->defaultLang;
        }

        $urlAsArray = explode('/', $this->url);
        $language = array_shift($urlAsArray);

        if (strlen($language) > 2) {
            return $this->defaultLang;
        }

        if (!in_array($language, $this->allowedLangs)) {
            throw new CoreException('There is no allowed lang - ' . $language);
        }
        return $this->allowedLangs[$language];
    }

    /**
     * @return string
     * @throws CoreException
     */
    private function setDefaultLang(): string
    {
        if (!array_key_exists(self::DEFAULT_LANG_KEY, $this->configParams)) {
            throw new CoreException('There is no default language config param');
        }

        $lang = $this->configParams[self::DEFAULT_LANG_KEY];

        if (strlen($lang) > 2 || $lang === '') {
            throw new CoreException('Configuration default language value is incorrect');
        }

        return $lang;
    }

    /**
     * @throws CoreException
     */
    private function includeDictionary(string $langCode): void
    {
        $dictionary = self::LANG_DICTIONARY_FILE . $langCode . DIRECTORY_SEPARATOR;
        if (!file_exists($dictionary . $langCode . '.php')) {
            throw new CoreException('There is no dictionary file ' . $langCode . '.php' . ' by filepath ' . $dictionary);
        }

        include_once $dictionary . $langCode . ".php";
    }

    /**
     * @param string $langCode
     * @return void
     */
    private function setupAppLang(string $langCode): void
    {
        define('APP_LANG', $langCode);
    }
}
