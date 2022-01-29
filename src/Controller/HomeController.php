<?php

declare(strict_types=1);

namespace Voopsc\Wild\Controller;

use Voopsc\Wild\Component\BaseController;

class HomeController extends BaseController
{

    public function home()
    {
        return $this->render('user/home.php');
    }
    
}