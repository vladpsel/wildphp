<?php

declare(strict_types=1);

namespace Voopsc\Wild\Component;

use Exception;
use Voopsc\Wild\Core\CoreException;
use Voopsc\Wild\Helper\ConfigExtractor;

class LangComponent
{

    /**
     * @param string $lang
     * @return string
     * @throws CoreException
     */
    public static function normalize(string $lang): string
    {
        $config = new ConfigExtractor();

        $defaultLang = $config->getConfigParam('defaultLang');

        $lang = trim($lang, "/");

        if ($lang === $defaultLang) {
            return "/";
        }
        return "/$lang/";
    }

    /**
     * @param string $filename
     * @return mixed
     * @throws Exception
     */
    public function getDictionary(string $filename): mixed
    {
        $dictFile = implode(DIRECTORY_SEPARATOR, [ROOT, 'translation', APP_LANG, $filename]);
        if (!file_exists($dictFile)) {
            throw new Exception('There is no dictionary file at ' . $dictFile);
        }
        return include $dictFile;
    }

    /**
     * HTML for lang list
     * @param array|null $classes
     * @return string
     * @throws CoreException
     */
    public function renderLangList(?array $classes = null)
    {
        $config = new ConfigExtractor();
        $langList = $config->getConfigFile(ROOT . '/config/allowed.lang.php');

        array_unshift($langList, $config->getConfigParam('defaultLang'));

        if (!empty($classes)) {
            $html = '<ul class="' . implode(' ', $classes) . '">';
        } else {
            $html = '<ul>';
        }

        foreach ($langList as $language) {
            $html .= '<li>';
            
            $html .= $this->getLangItem($language);
            $html .= '</li>';
        }


        $html .= "</ul>";
        print_r($html);
        return $html;
    }

    /**
     * HTML Template for single lang item
     * @param string|null $lang
     * @return string|null
     * @throws CoreException
     */
    private function getLangItem(?string $lang): ?string
    {
        if (empty($lang)) {
            return null;
        }

        $html = '<a href="'. self::normalize($lang) . '"';
        if (APP_LANG === $lang) {
            $html .= 'class="selected"';
        }
        $html .= '>' . ucfirst($lang) . '</a>';

        return $html;
    }


}