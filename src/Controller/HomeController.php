<?php

declare(strict_types=1);

namespace Voopsc\Wild\Controller;

use Exception;
use Voopsc\Wild\Component\BaseController;
use Voopsc\Wild\Component\LangComponent;
use Voopsc\Wild\Response\View;

class HomeController extends BaseController
{

    /**
     * @throws Exception
     */
    public function home(): View
    {
        $lang = new LangComponent();
        $content = $lang->getDictionary('home.php');

        return $this->render('user/home.php', [
            ['content' => $content],
        ]);
    }
    
}